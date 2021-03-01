<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Cart;
use App\Notifications\CustomerRequestNotification;
use Modules\Admin\Entities\Admin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::get();

        if($request->order!=''){
            $order = Cart::get($request->order);
            $item = $order->attributes->items[$request->item];
            $view['order'] = $order->attributes->toArray();
            $view['order']['id'] = $order->id;
            $view['order']['items'] = [];
            $view['order']['items'][1] = $item;
            $view['item'] = $request->item;
        }
        
        return view('welcome')->with($view);
        if(auth()->user()->user_type=='Sender'){
            return redirect()->to(url('sender'));
        }
        else if(auth()->user()->user_type=='Traveller'){
            return redirect()->to(url('traveller'));
        }
        else{
            return front_force_logout();
        }
    }

    public function customer_request(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        try{
            $admin = Admin::first();
            $request->admin = $admin;
            $admin->notify(new CustomerRequestNotification($request));
        }
        catch(\Exception $e){}
        return front_success_response();
    }
}
