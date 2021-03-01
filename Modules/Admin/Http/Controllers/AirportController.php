<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Airport;

class AirportController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['records'] = Airport::orderBy('name')->get();
        return view('admin::airport.index')->with($view);
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
            'name' => 'required|unique:airports',
            'address' => 'required',
        ]);
        $data = $request->all();
        Airport::create($data);
        $response = ['message'=>'store'];
        return admin_success_response($response);
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
        $data['record'] = Airport::find($id);
        return view('admin::airport.edit')->with($data);
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
            'name' => 'required|unique:airports,name,'.$id,
            'address' => 'required',
        ]);
        $data = $request->all();
        Airport::find($id)->update($data);
        $response = ['message'=>'update'];
        return admin_success_response($response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Airport::find($id)->delete();
        $response = ['message'=>'destroy'];
        return admin_success_response($response);
    }
}
