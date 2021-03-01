<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Package;

class PackageController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['records'] = Package::orderBy('weight')->get();
        return view('admin::package.index')->with($view);
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
            'weight' => 'required|unique:packages',
            'currency_symbol' => 'required',
            'currency_code' => 'required',
            'price' => 'required|numeric',
        ]);
        $data = $request->all();
        Package::create($data);
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
        $data['record'] = Package::find($id);
        return view('admin::package.edit')->with($data);
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
            'weight' => 'required|unique:packages,weight,'.$id,
            'currency_symbol' => 'required',
            'currency_code' => 'required',
            'price' => 'required|numeric',
        ]);
        $data = $request->all();
        Package::find($id)->update($data);
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
        Package::find($id)->delete();
        $response = ['message'=>'destroy'];
        return admin_success_response($response);
    }
}
