@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv">
                    <div class="login-reg-heading">
                        <p><img src="{{ front_image('login-iconpg.png') }}"> Login</p>
                    </div>
					<form method="POST" action="{{ route('login') }}" class="form ms-account-box">
                        @csrf
                        <h3 class="log-title">Login to <span>Yankit</span></h3>
                        <div class="form-group">
                            <label for="email">Email Address<span class="req-star">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @elseif(Session::has('email')) is-invalid @enderror" name="email" id="email" placeholder="Enter Email Address" required>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
                            @elseif(Session::has('email'))
                                <span class="invalid-feedback" role="alert">
									<strong>{{ Session::pull('email') }}</strong>
								</span>
							@enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span class="req-star">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="*******" required>
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="login-btndv">
                                        <button type="submit" class="btn btn-dark loginbtn">LOGIN</button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span class="custom-checkbox">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Remember Me</label>
                                    </span>	
                                </div>
								@if (Route::has('password.request'))
									<div class="col-md-6 col-sm-6 col-xs-6">
										<p align="right" class="forgetpsw"><a href="{{ route('password.request') }}">Forget Password?</a></p>
									</div>
								@endif
								@if (Route::has('register'))
									<div class="col-md-12 col-sm-12 col-xs-12">
										<hr class="hr-formobile-login" style="border-color: #DBDBDB">
										<span class="or">or</span>
										<p class="notregister-p" align="center">Not registered yet, <a href="{{ route('register') }}">Create an account</a></p>
									</div>
								@endif
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
