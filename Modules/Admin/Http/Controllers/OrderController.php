<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Sender\Entities\Order;
use Modules\Sender\Entities\Item;
use Modules\Traveller\Entities\Journey;
use Modules\Admin\Entities\JourneyComment;
use Modules\Sender\Entities\Sender;
use Modules\Traveller\Entities\Traveller;
use Modules\Admin\Notifications\SenderOrderStatusNotification;
use Modules\Admin\Notifications\TravellerOrderStatusNotification;
use Modules\Admin\Notifications\SenderOrderPaymentStatusNotification;
use Modules\Admin\Notifications\SenderOrderUnassignedNotification;
use Modules\Admin\Notifications\TravellerOrderUnassignedNotification;
use Modules\Admin\Notifications\SenderOrderAssignedNotification;
use Modules\Admin\Notifications\TravellerOrderAssignedNotification;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $where = [];
        if($request->status && $request->status!=''){
            $where['status'] = $request->status;
        }
        $view['records'] = Order::where($where)->orderBy('id', 'desc')->get();
        return view('admin::order.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $view['record'] = Order::find($id);
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::pluck('weight', 'id')->toArray();
        return view('admin::order.show')->with($view);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'departure_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'pickup_date' => 'required:date',
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'required',
        ]);
        $data = $request->all();
        $order = Order::find($id);
        $order->update($data);
        if($order->wasChanged('status')){
            // send status changed notification to sender and traveller(if assigned)
            // return (new TravellerOrderStatusNotification($order))->toMail(auth('admin')->user());
            try{
                $order->previous_status = $order->getOriginal('status');
                Sender::find($order->sender_id)->notify(new SenderOrderStatusNotification($order));
                if($order->journey){
                    Traveller::find($order->journey->traveller->id)->notify(new TravellerOrderStatusNotification($order));
                }
            }
            catch(\Exception $e){}
        }
        if($order->wasChanged('payment_status')){
            // send payment status changed notification sender
            try{
                $order->previous_status = $order->getOriginal('payment_status');
                Sender::find($order->sender_id)->notify(new SenderOrderPaymentStatusNotification($order));
            }
            catch(\Exception $e){}
        }
        foreach($request->items as $key=>$val){
            if($val['package_id']!=''){
                $package = Package::find($val['package_id']);
                $val['package_id'] = $package->id;
                $val['weight'] = $package->weight;
                $val['currency_symbol'] = $package->currency_symbol;
                $val['currency_code'] = $package->currency_code;
                $val['price'] = $package->price;
                Item::find($key)->update($val);
            }
            else{
                Item::destroy($key);
            }
        }
        $response = ['message' => 'update'];
        return admin_success_response($response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        $response = ['message'=>'destroy'];
        return admin_success_response($response);
    }

    public function assign_order(Request $request){
        $order = Order::find($request->id);
        $view['journey'] = Journey::where(['departure_airport_id'=>$order->departure_airport_id, 'destination_airport_id'=>$order->destination_airport_id, 'pickup_date'=>$order->pickup_date])->get();
        $view['record'] = $order;
        return view('admin::order.assign')->with($view);
    }

    public function update_journey(Request $request, $id){
        $data = $request->all();
        $data['status'] = $data['journey_id']==''?'Pending':'Assigned';
        $order = Order::find($id)->update($data);
        foreach($request->comments as $key=>$val){
            $key = $key==0?null:$key;
            $comment = JourneyComment::where(['journey_id'=>$key, 'order_id'=>$id])->first();
            if($comment){
                $comment->update(['comment'=>$val]);
            }
            else if($val!=''){
                JourneyComment::create(['order_id'=>$id, 'journey_id'=>$key, 'comment'=>$val]);
            }
        }
        try{
            $order = Order::find($id);
            // send order unassigned notification to sender and traveller
            $journey = Journey::find($order->getOriginal('journey_id'));
            if($journey){
                Sender::find($order->sender_id)->notify(new SenderOrderUnassignedNotification($order));
                Traveller::find($order->journey->traveller_id)->notify(new TravellerOrderUnassignedNotification($order));
            }

            // send order assigned notification to sender and traveller
            Sender::find($order->sender_id)->notify(new SenderOrderAssignedNotification($order));
            if($order->journey){
                Traveller::find($order->journey->traveller_id)->notify(new TravellerOrderAssignedNotification($order));
            }
        }
        catch(\Exception $e){}

        $response = ['message' => 'update'];
        return admin_success_response($response);
    }
}
