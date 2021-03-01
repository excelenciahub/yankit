@extends('admin::layouts.master')
@section('title', 'Profile')
@section('breadcrumb', 'Profile')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($admin, ['route'=>['admin.profile.update', $admin->id], 'method' => 'PATCH', 'novalidate' => 'novalidate', 'class'=>'validation']) }}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                {{ Form::text('first_name', old('first_name'), ['class'=>'form-control', 'placeholder'=>'Enter first name', 'id'=>'first_name', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid first name.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                {{ Form::text('last_name', old('last_name'), ['class'=>'form-control', 'placeholder'=>'Enter last name', 'id'=>'last_name', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid last name.
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
                                <label for="username">Username</label>
                                {{ Form::text('username', old('username'), ['class'=>'form-control', 'placeholder'=>'Enter username', 'id'=>'username', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid username.
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                {{ Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter email', 'id'=>'email', 'required'=>true]) }}
                                <div class="invalid-feedback">
                                    Please provide valid email.
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
