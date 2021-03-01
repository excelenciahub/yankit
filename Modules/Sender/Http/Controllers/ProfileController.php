<?php

namespace Modules\Sender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Auth;

class ProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $view['user'] = auth()->user();
        return view('sender::profile.index')->with($view);
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
        $user = auth()->user();
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.',id,user_type,'.$user->user_type.'',
            // 'phone' => 'required',
            'avatar' => 'image',
        ];
        if($request->password!='' || $request->password_confirmation!=''){
            $rules['password'] = 'required|confirmed|string|min:8';
        }
        $request->validate($rules);
        $data = $request->all();
        if($request->file('avatar')){
            $avatar = $request->file('avatar');
            $name = time().'-'.$avatar->getClientOriginalName();
            $avatar->storeAs(USER_STORAGE_PATH, $name);
            $data['avatar'] = $name;
        }
        if($request->password==''){
            unset($data['password']);
        }
        $user = Auth::user();
        $user->update($data);
        if($user->social_provider!=''){
            $dirty = json_encode(array_keys($user->getChanges()));
            $user->update(['dirty'=>$dirty]);
        }
        $response = front_success_response(['message'=>'update']);
        return response()->json($response);
        return redirect()->back()->with($response);
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
        return view('sender::profile.change-password');
    }

    public function update_password(Request $request)    
    {
        $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|confirmed|string|min:8',
                'new_password_confirmation' => 'required|string',
            ]);

        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            return redirect()->back()->with("error","Your old password does not matches with the password you provided. Please try again.");
        }
        else if(strcmp($request->old_password, $request->new_password) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your old password. Please choose a different password.");
        }
        $user = Auth::user();
        $user->password = $request->new_password;
        $user->save();
        $response = front_success_response(['message'=>'password_update']);
        return redirect()->back()->with($response);
    }
}
