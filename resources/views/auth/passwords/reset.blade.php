@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<main style="margin-top: 135px;">

		<div class="container margin_60">
			<div class="row">
				<div class="col-md-6">
					<div class="form_title">
						<h3><strong><i class="icon-pencil"></i></strong>Reset Your Password</h3>
						
					</div>
					<div class="step">

						<div id="message-contact"></div>
                        <form method="POST" action="{{ route('password.update') }}" id="contactform" class="form ajaxform" novalidate="true">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
						<input id="email" type="hidden" name="email" value="{{ $email ?? old('email') }}" />
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" class="form-control" id="lastname_contact" name="password_confirmation" placeholder="Confirm Password">
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-6">
									
									<button type="sumit" class="btn_login">SUBMIT</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				

				
			</div>
		</div>
</main>
@endsection
