<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Hash;

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['admin'] = auth()->guard('admin')->user();
        return view('admin::profile.index')->with($view);
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
        $admin = auth()->guard('admin')->user();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:admins,email,'.$admin->id,
            'email' => 'required|unique:admins,email,'.$admin->id
        ]);
        $data = $request->all();
        
        $admin->update($data);
        return admin_success_response(['message'=>'update']);;
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

    public function change_password(){
        return view('admin::profile.change-password');
    }

    public function update_password(Request $request)    
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|confirmed|string|min:8',
            'new_password_confirmation' => 'required|string',
        ]);
        $admin = auth()->guard('admin')->user();
        
        if (!(Hash::check($request->old_password, $admin->password))) {
            throw ValidationException::withMessages(['old_password'=>'Your old password does not matches with the password you provided. Please try again.']);
        }
        else if(strcmp($request->old_password, $request->new_password) == 0){
            throw ValidationException::withMessages(['new_password'=>'New Password cannot be same as your old password. Please choose a different password.']);
        }
        $admin->password = $request->new_password;
        $admin->save();
        return admin_success_response(['message'=>'password_update']);
    }
}
