@extends('layouts.app')
@section('title', 'Confirm Password')
@section('content')
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv">	
                    <form class="form ms-account-box">							
                        <h3 class="log-title">Confirm <span>Password</span></h3>
                        <p>Please confirm your password before continuing.</p>
                        <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
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
                                        <button type="submit" class="btn btn-dark loginbtn">Confirm Password</button>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
									<div class="col-md-12 col-sm-12">
										<pclass="forgetpsw"><a href="{{ route('password.request') }}">Forget Password?</a></pclass=>
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
