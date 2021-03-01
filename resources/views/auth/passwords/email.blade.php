@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv register-confirmationdv">
                    <form method="POST" action="{{ route('password.email') }}" class="form ms-account-box">
                        @csrf
                        <h3 class="log-title">Recover <span>Password</span></h3>
                        @if(Session::has('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <p>Enter the email address associated with your Yankit account. </p>
                        <div class="form-group">
                            <label for="email">Email Address<span class="req-star">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="login-btndv">
                                        <button type="submit" class="btn btn-dark loginbtn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection
