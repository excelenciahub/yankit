<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Traveller\Entities\Journey;

class JourneyController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['records'] = Journey::orderBy('id', 'desc')->get();
        return view('admin::journey.index')->with($view);
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
        $view['record'] = Journey::find($id);
        $view['airports'] = Airport::orderBy('name')->pluck('name', 'id')->toArray();
        $view['packages'] = Package::pluck('weight', 'id')->toArray();
        return view('admin::journey.show')->with($view);
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
        Journey::find($id)->update($data);
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
        Journey::find($id)->delete();
        $response = ['message' => 'destroy'];
        return admin_success_response($response);
    }

    public function orders($id){
        $view['journey'] = Journey::find($id);
        return view('admin::journey.orders')->with($view);
    }
}
