@extends('sender::layouts.master')
@section('title', 'Change Password')
@section('content')
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv">	
                    {{ Form::open(['route'=>['sender.profile.update-password'], 'class'=>'form ms-account-box']) }}
                        <h3 class="log-title resetnewpswt">Change <span>Password</span></h3>
                        @include('sender::layouts.message')
                        <div class="form-group">
                            <label for="old_password">Old Password<span class="req-star">*</span></label>
                            {{ Form::password('old_password', ['class'=>'form-control', 'id'=>'old_password', 'placeholder'=>'Old Password']) }}
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password<span class="req-star">*</span></label>
                            {{ Form::password('new_password', ['class'=>'form-control', 'id'=>'new_password', 'placeholder'=>'New Password']) }}
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm Password<span class="req-star">*</span></label>
                            {{ Form::password('new_password_confirmation', ['class'=>'form-control', 'id'=>'new_password_confirmation', 'placeholder'=>'Confirm Password']) }}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="login-btndv">
                                        <button type="submit" class="btn btn-dark loginbtn">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection
