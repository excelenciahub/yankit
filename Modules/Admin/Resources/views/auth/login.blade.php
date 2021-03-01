@extends('admin::layouts.auth')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-pattern">
            <div class="card-body p-4">
                <div class="text-center w-75 m-auto">
                    <div class="auth-logo">
                        <a href="#" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="{{ admin_image('logo.png') }}" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                </div>
                @if(Session::has('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                {{ Form::open(['route' => 'admin.login']) }}
                    <div class="form-group mb-3">
                        <label for="username">Email address</label>
                        {{ Form::text('username', old('username'), ['class'=>'form-control', 'id'=>'username', 'placeholder'=>'Your your email','autofocus'=>'true']) }}
                        @error('username')
                            <span class="error" role="alert">{{ $message }}</span>
                        @enderror
                        @error('email')
                            <span class="error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        @if (Route::has('admin.password.request'))
                            <a href="{{ route('admin.password.request') }}" class="text-muted font-13 float-right">Forgot your password?</a>
                        @endif
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge">
                            {{ Form::password('password',['class'=>'form-control', 'placeholder'=>'Enter your password']) }}
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                    </div>
                {{ Form::close() }}
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection