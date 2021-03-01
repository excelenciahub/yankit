@extends('admin::layouts.auth')
@section('title', 'Reset Password')
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
                    <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                </div>
                @if(Session::has('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                {{ Form::open(['route' => 'admin.password.email']) }}
                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        {{ Form::email('email', old('email'), ['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Your your email','autofocus'=>'true']) }}
                        @error('email')
                            <span class="error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> Send Password Reset Link </button>
                    </div>
                {{ Form::close() }}
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-white-50">Back to <a href="{{ route('admin.login') }}" class="text-white ml-1"><b>Log in</b></a></p>
            </div> <!-- end col -->
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection