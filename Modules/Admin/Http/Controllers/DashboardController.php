<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Traveller\Entities\Traveller;
use Modules\Sender\Entities\Sender;
use Modules\Sender\Entities\Order;

class DashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $statistics['airports'] = Airport::count();
        $statistics['packages'] = Package::count();
        $statistics['travellers'] = Traveller::count();
        $statistics['senders'] = Sender::count();
        $statistics['pending_orders'] = Order::where(['status'=>'Pending'])->count();
        $statistics['picked_up_orders'] = Order::where(['status'=>'Picked Up'])->count();
        $statistics['delivered_orders'] = Order::where(['status'=>'Delivered'])->count();
        $statistics['cancelled_orders'] = Order::where(['status'=>'Cancelled'])->count();
        $view['statistics'] = $statistics;

        return view('admin::dashboard')->with($view);
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
}
