<?php

namespace Modules\Sender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Cart;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $crt = Cart::getContent();
        $cart = [];
        foreach($crt as $val){
            $cart[$val->id] = $val;
        }
        ksort($cart);

        $view['cart'] = $cart;
        return view('sender::order.cart')->with($view);
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
        $request->validate([
            'departure_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'pickup_date' => 'required:date|after:yesterday',
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'required',
            'items.*.weight' => 'required',
            'items.*.description' => 'required',
        ],[
            'items.*.weight.required' => 'The weight field is required.',
            'items.*.description.required' => 'What are you sending field is required.',
        ]);
        if(auth()->user()->user_type!='Sender'){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'user' => ['Please login with sender account.'],
            ]);
            throw $error;
        }
        else if(auth()->user()->email==''){
            return response()->json(['message'=>'Please add your email to continue.', 'redirect'=>route('sender.profile.index')], 403);
        }
        $crt = Cart::getContent();
        $cart = [];
        foreach($crt as $val){
            $cart[$val->id] = $val;
        }
        foreach($cart as $key=>$val){
            Cart::remove($val->id);
        }
        $data = $request->all();
        unset($data['_token']);
        $user_id = auth()->user()->id;
        $cart['id'] = time();
        $cart['name'] = '-';
        $cart['price'] = 0;
        $cart['quantity'] = 1;
        $data['total_quantity'] = 0;
        $data['items'] = array_values($data['items']);
        $data['departure_airport'] = Airport::find($data['departure_airport_id']);
        $data['destination_airport'] = Airport::find($data['destination_airport_id']);
        foreach($data['items'] as $key=>$val){
            $package = Package::find($val['weight']);
            $data['items'][$key]['package'] = $package;
            $cart['price'] += $package->price;
            $data['currency_symbol'] = $package->currency_symbol;
            $data['currency_code'] = $package->currency_code;
            $data['total_quantity']++;
        }
        $cart['attributes'] = $data;
        Cart::add($cart);
        return response()->json(['status'=>true, 'message'=>'Order added in cart', 'redirect'=>route('sender.cart.index')]);
        return redirect()->to(route('sender.cart.index'));
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
            'items' => 'required|array',
        ]);
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        unset($data['item']);
        
        $crt = Cart::get($id);

        $user_id = auth()->user()->id;
        $cart['id'] = $crt->id;
        $cart['name'] = '-';
        $cart['price'] = 0;
        $cart['quantity'] = $crt->quantity;
        $data['total_quantity'] = 0;
        $data['items'] = $crt->attributes->items;
        unset($data['items'][$request->item]);
        $data['departure_airport'] = Airport::find($data['departure_airport_id']);
        $data['destination_airport'] = Airport::find($data['destination_airport_id']);
        $key = 0;
        foreach($data['items'] as $key=>$val){
            $package = Package::find($val['weight']);
            $data['items'][$key]['package'] = $package;
            $cart['price'] += $package->price;
            $data['currency_symbol'] = $package->currency_symbol;
            $data['currency_code'] = $package->currency_code;
            $data['total_quantity']++;
        }
        foreach($request->items as $k=>$val){
            $key++;
            $package = Package::find($val['weight']);
            $data['items'][$key] = $val;
            $data['items'][$key]['package'] = $package;
            $cart['price'] += $package->price;
            $data['currency_symbol'] = $package->currency_symbol;
            $data['currency_code'] = $package->currency_code;
            $data['total_quantity']++;
        }
        $cart['attributes'] = $data;
        Cart::remove($id);
        Cart::add($cart);
        // return $cart;

        return response()->json(['status'=>true, 'message'=>'Cart updated successfully.', 'redirect'=>route('sender.cart.index')]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $crt = Cart::get($id);
        if($request->item=='ALL'){
            Cart::clear();
        }
        else if($crt->attributes->total_quantity>1){
            $user_id = auth()->user()->id;
            $cart['id'] = $crt->id;
            $cart['name'] = '-';
            $cart['price'] = 0;
            $cart['quantity'] = $crt->quantity;
            $data['total_quantity'] = 0;
            $data['items'] = $crt->attributes->items;
            unset($data['items'][$request->item]);
            $data['departure_airport_id'] = $crt->attributes->departure_airport_id;
            $data['destination_airport_id'] = $crt->attributes->destination_airport_id;
            $data['pickup_date'] = $crt->attributes->pickup_date;
            $data['pickup_start_time'] = $crt->attributes->pickup_start_time;
            $data['pickup_end_time'] = $crt->attributes->pickup_end_time;
            $data['departure_airport'] = Airport::find($crt->attributes->departure_airport_id);
            $data['destination_airport'] = Airport::find($crt->attributes->destination_airport_id);
            foreach($data['items'] as $key=>$val){
                $package = Package::find($val['weight']);
                $data['items'][$key]['package'] = $package;
                $cart['price'] += $package->price;
                $data['currency_symbol'] = $package->currency_symbol;
                $data['currency_code'] = $package->currency_code;
                $data['total_quantity']++;
            }
            $cart['attributes'] = $data;
            Cart::remove($id);
            Cart::add($cart);
        }
        else{
            Cart::remove($id);
        }
        return response()->json(['status'=>true, 'message'=>'Cart updated successfully.']);
    }
}
