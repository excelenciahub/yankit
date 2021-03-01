@extends('admin::layouts.master')
@section('title', 'Change Password')
@section('breadcrumb', 'Change Password')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::open(['route'=>['admin.profile.update-password'], 'novalidate' => 'novalidate', 'class'=>'validation']) }}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                {{ Form::password('old_password', ['class'=>'form-control', 'id'=>'old_password', 'placeholder'=>'Enter old password', 'id'=>'old_password', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid old password.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                {{ Form::password('new_password', ['class'=>'form-control', 'id'=>'new_password', 'placeholder'=>'Enter new password', 'id'=>'new_password', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid new password.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm Password</label>
                                {{ Form::password('new_password_confirmation', ['class'=>'form-control', 'id'=>'new_password_confirmation', 'placeholder'=>'Confirm password', 'id'=>'new_password_confirmation', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid confirm password.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        {{ Form::close() }}
    </div><!-- end col-->
</div>
<!-- end row-->
@endsection
