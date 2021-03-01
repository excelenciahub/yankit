@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="login-form-mainsec">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-12"></div>
			<div class="col-md-4 col-sm-12">
				<div class="loginform-dv">
					<div class="login-reg-heading">
						<p><img src="{{ front_image('login-iconpg.png') }}"> Register</p>
					</div>
                    <form novalidate method="POST" action="{{ route('register') }}" class="form ms-account-box">
                        @csrf
						<h3 class="log-title">Create an <span>Account</span></h3>
						<div class="form-group">
							<label for="inputEmail">I am a<span class="req-star">*</span></label>
							<div class="registerpg-radio @error('user_type') is-invalid @enderror">
								<label class="radio-button">
								<input type="radio" class="radio-button__input" id="choice1-1" name="user_type" value="Sender" {{ old('user_type')=='Sender'?'checked="checked"':'' }}>
								<span class="radio-button__control"></span>
								<span class="radio-button__label">Sender</span>
								</label>
								<label class="radio-button">
								<input type="radio" class="radio-button__input" id="choice1-2" name="user_type" value="Traveller" {{ old('user_type')=='Traveller'?'checked="checked"':'' }}>
								<span class="radio-button__control"></span>
								<span class="radio-button__label">Traveler</span>
								</label>
							</div>
							@error('user_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group">
							<label for="name">Full Name<span class="req-star">*</span></label>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group">
							<label for="email">Email Address<span class="req-star">*</span></label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group">
							<label for="phone">Phone Number</label>
							<input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
							<label for="password-confirm">Confirm Password<span class="req-star">*</span></label>
							<input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="*******" required>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="login-btndv">
                                    <button type="submit" class="btn btn-dark loginbtn">Register</button>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<hr style="border-color: #DBDBDB">
									<span class="or">or</span>
									<p class="notregister-p" align="center">Already Registered, <a href="{{ route('login') }}">Login Here</a></p>
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
