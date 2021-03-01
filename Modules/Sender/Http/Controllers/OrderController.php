<?php

namespace Modules\Sender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sender\Entities\Order;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Sender\Entities\Item;
use Modules\Sender\Notifications\NewOrderSenderNotification;
use Modules\Sender\Notifications\NewOrderAdminNotification;
use Modules\Sender\Notifications\SenderOrderPaymentNotification;
use Modules\Sender\Notifications\AdminOrderPaymentNotification;
use Modules\Sender\Entities\Sender;
use Modules\Admin\Entities\Admin;
use Modules\Sender\Entities\Payment;
use Cart;
use Cartalyst\Stripe\Stripe;
use Exception;
use Carbon\Carbon;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['orders'] = Order::where(['sender_id'=>auth()->user()->id])->orderBy('id', 'desc')->paginate(FRONT_RECORD_PER_PAGE);
        return view('sender::order.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::get();
        return view('sender::order.create')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'terms' => 'accepted',
        ]);
        $request->token = json_decode($request->token, true);
        $user_id = auth()->user()->id;
        $crt = Cart::getContent();
        if(count($crt)==0){
            $response['redirect'] = route('dashboard');
            return response()->json($response);
        }
        $finalAmount = Cart::getTotal();
        $currency_symbol = $currency_code = '';
        $cart = [];
        foreach($crt as $val){
            $cart[$val->id] = $val;
        }
        ksort($cart);
        $order_ids = [];
        foreach($cart as $key=>$val){
            $address = isset($request->custom_address) && isset($request->custom_address[$val->id])?$request->custom_address[$val->id]:null;
            $order = $val->attributes->toArray();
            $order['sender_id'] = $user_id;
            $order['custom_address'] = $address;
            $order = Order::create($order);
            $order_ids[] = $order->id;
            foreach($val->attributes->items as $k=>$v){
                $package = $v['package'];
                $item = [
                    'order_id' => $order->id,
                    'package_id' => $package->id,
                    'weight' => $package->weight,
                    'description' => isset($v['description'])?$v['description']:'',
                    'currency_symbol' => $package->currency_symbol,
                    'currency_code' => $package->currency_code,
                    'price' => $package->price,
                ];
                Item::create($item);
                $currency_symbol = $package->currency_symbol;
                $currency_code = $package->currency_code;
            }
            // Cart::remove($val->id);
        }
        // send notification to sender and admin
        try{
            Sender::find(auth()->user()->id)->notify(new NewOrderSenderNotification($order));
            $admin = Admin::first();
            $order->admin = $admin;
            $admin->notify(new NewOrderAdminNotification($order));
        }
        catch(\Exception $e){}

        $status = 200;
        try{
            $sender = auth()->user();
            $stripe = Stripe::make(config('services.stripe.secret'));
            $customers = $stripe->customers()->all(['email'=>$request->token['email']])['data'];
            $source = [];
            if(false && count($customers)>0){
                $customer = $customers[0];
                $source['source'] = $request->token['id'];
            }
            else{
                $customer = $stripe->customers()->create(
                        [
                            'email' => $request->token['email'],
                            'name' => $sender->name,
                            'address' => [
                                'line1' => '510 Townsend St',
                                'postal_code' => '98140',
                                'city' => 'San Francisco',
                                'state' => 'CA',
                                'country' => 'US',
                            ],
                            'source' => $request->token['id'],
                        ]
                    );
            }
            $result = $stripe->charges()->create(
                [
                    'amount' => $finalAmount,
                    'currency' => $currency_code,
                    'description' => $sender->name.' Order('.$order->order_no.') Payment - '.config('app.name'),
                    'customer' => $customer['id'],
                ]+$source
            );
            if($result['status']=='succeeded'){
                $payment_status = $result['paid']===true?'Success':'Failed';
                $payment = ['order_id'=>$order->id, 'payment_method'=>'Stripe', 'payment_date'=>Carbon::now()->format('Y-m-d'), 'currency_code'=>$result['currency'], 'currency_symbol'=>$currency_symbol, 'price'=>($result['amount']/100), 'payment_data'=>json_encode($result), 'payment_status'=>$payment_status];
                Payment::create($payment);
                $order->update(['payment_status'=>$payment_status]);
                // send payment notification to sender and admin
                try{
                    Sender::find($sender->id)->notify(new SenderOrderPaymentNotification($order));
                    $admin = Admin::first();
                    $order->admin = $admin;
                    $admin->notify(new AdminOrderPaymentNotification($order));
                }
                catch(\Exception $e){}

                foreach($cart as $key=>$val){
                    Cart::remove($val->id);
                }
                $response = ['success'=>true, 'message'=>'Payment successfully done.', 'result'=>$result];
            }
            else{
                Order::destroy($order_ids);
                $response = ['success'=>false, 'message'=>'Payment was failed.', 'result'=>$result];
                $status = 403;
            }
        }
        catch(Exception $e){
            Order::destroy($order_ids);
            $response = ['success'=>false, 'message'=>'Payment was failed.', 'error'=>$e->getMessage()];
            $status = 403;
        }
        $response['redirect'] = route('sender.order.complete');
        return response()->json($response, $status);
        return redirect()->to(route('sender.order.complete'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::get();
        $order = Cart::get($id);
        $item = $order->attributes->items[$request->item];
        $view['order'] = $order->attributes->toArray();
        $view['order']['id'] = $order->id;
        $view['order']['items'] = [];
        $view['order']['items'][1] = $item;
        $view['item'] = $request->item;

        return view('sender::order.create')->with($view);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function complete(){
        return view('sender::order.complete');
    }
}
