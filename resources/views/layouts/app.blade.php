<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Yankit">
		<meta name="author" content="">
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {{ config('app.name') }}</title>
		<link rel="shortcut icon" href="{{ front_image('pop-logo.png') }}" type="image/x-icon">
		<link rel="stylesheet" href="{{ front_plugin('select2/select2.min.css') }}">
		<link rel="stylesheet" href="{{ front_plugin('sweetalert2/sweetalert2.min.css') }}">
		<!-- <link href="{{ front_css('css.css') }}?family=Gochi+Hand|Montserrat:300,400,700" rel="stylesheet"> -->
		<link href="{{ front_css('bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ front_css('style.css') }}" rel="stylesheet">
		<link href="{{ front_css('vendors.css') }}" rel="stylesheet">
		<link href="{{ front_css('custom.css') }}" rel="stylesheet">
		<link href="{{ front_css('frontend.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="preloader" style="{{ isCurrentRoute('dashboard') || isCurrentRoute('home')?'':'display: none;' }}">
			<div class="sk-spinner sk-spinner-wave">
				<div class="sk-rect1"></div>
				<div class="sk-rect2"></div>
				<div class="sk-rect3"></div>
				<div class="sk-rect4"></div>
				<div class="sk-rect5"></div>
			</div>
		</div>
		<div class="layer"></div>
		<header class="{{ isCurrentRoute('dashboard') || isCurrentRoute('home')?'':'bg-cl-hd' }}">
			<div class="container">
				<div class="row">
					<div class="col-3">
						<div id="logo_home">
							<a href="{{ route('dashboard') }}"><img src="{{ front_image('logo.png') }}"></a>
						</div>
					</div>
					<nav class="col-9">
						<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#"><span>Menu mobile</span></a>
						<div class="main-menu" id="main-menu">
							<div id="header_menu">
								<img src="{{ front_image('logo.png') }}" width="160" height="34" alt="City tours" data-retina="true">
							</div>
							<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
							<ul>
								<li class="submenu">
									<a href="{{ route('dashboard') }}" class=" "><span class="active-gs {{ isCurrentRoute('dashboard') || isCurrentRoute('home')?'active':'' }}">Home</span> </a>
								</li>
								<li class="submenu">
									<a href="{{ route('about-us') }}" ><span class="active-gs  {{ isCurrentRoute('about-us')?'active':'' }}">About</span> </a>
								</li>
								<li class="submenu">
									<a href="{{ route('contact-us.index') }}" ><span class="active-gs  {{ isCurrentRoute('contact-us.index')?'active':'' }}">Contact Us </span></a>
								</li>
								@guest
								<li class="submenu">
									<a href="#sign-in-dialog" class="access_link"><span class="btn-gs">Sign In </span></a>
								</li>
								<li class="submenu">
									<a href="#sign-up-dialog" class="access_link"><span class="btn-gs-2">Sign Up</span> </a>
								</li>
								@elseif(auth()->user()->user_type=='Sender')
								<li class="submenu">
									<a href="#" class="show-submenu">{{ auth()->user()->name }} <img src="{{ auth()->user()->avatar_url==''?front_image('avatar3.jpg'):auth()->user()->avatar_url }}"></a>
									<ul>
										<li><a href="{{ route('sender.profile.index') }}">Profile</a></li>
										<li><a href="{{ route('sender.order.index') }}">My Requests </a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a><form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form></li>
									</ul>
								</li>
								@elseif(auth()->user()->user_type=='Traveller')
								<li class="submenu">
									<a href="#" class="show-submenu">{{ auth()->user()->name }} <img src="{{ auth()->user()->avatar_url==''?front_image('avatar3.jpg'):auth()->user()->avatar_url }}"></a>
									<ul>
										<li><a href="{{ route('traveller.profile.index') }}">Profile</a></li>
										<li><a href="{{ route('traveller.journey.index') }}">My Journey </a></li>
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a><form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form></li>
									</ul>
								</li>
								@endguest
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</header>
		@yield('content')
		<footer class="revealed">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="ft-lofo">
							<img src="{{ front_image('white_logo.png') }}" width="100">
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is </p>
						</div>
					</div>
					<div class="col-md-4">
						<h3>UseFul Links</h3>
						<ul>
							<li><a href="{{ route('about-us') }}">About us</a></li>
							<li><a href="{{ route('contact-us.index') }}">Contact Us</a></li>
							<li><a href="{{ route('terms-condition') }}">Terms & condition</a></li>
							<li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
						</ul>
					</div>
					<div class="col-md-4">
						<h3>Get in Touch</h3>
						<div class="social-ft">
							<span> <a href="https://facebook.com/" target="_blank"><img src="{{ front_image('fb.png') }}"> </a></span>
							<span> <a href="https://plus.google.com/" target="_blank"><img src="{{ front_image('g-plus') }}.png"> </a></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="social_footer">
							<p>© 2020 | Yankit, All Rights Reserved , Designed By <a href="https://www.supportsoft.com.au/" target="_blank">Supportsoft</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
			<div class="small-dialog-header">
				<img src="{{ front_image('pop-logo.png') }}">
				<h4>Welcome to Yankit </h4>
			</div>
			<form method="POST" action="{{ route('login') }}" class="form ajaxform ms-account-box">
				@csrf
				<div class="sign-in-wrapper">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" id="email">
						<i class="icon_mail_alt"></i>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" id="password" value="">
						<i class="icon_lock_alt"></i>
					</div>
					<div class="clearfix add_bottom_15">
						<div class="checkboxes float-left">
							<input id="remember-me" name="remember" type="checkbox" name="check">
							<label for="remember-me">Remember Me</label>
						</div>
						<div class="float-right"><a id="forgot" href="#forgot-dialog" class="access_link">Forgot Password?</a></div>
					</div>
					<div class="text-center"><input type="submit" value="Log In" class="btn_login"></div>
					<div class="divider"><span>Or</span></div>
					<div class="row">
						<div class="col-6">
							<a href="{{ route('social-login', ['social'=>'facebook']) }}" class="social_bt social_link facebook">Facebook</a>
							<a href="#user-type" id="social_dialog_link" class="access_link hide">login</a>
						</div>
						<div class="col-6">
							<a href="{{ route('social-login', ['social'=>'google']) }}" class="social_bt social_link google">Google</a>
						</div>
					</div>
					<div class="text-center">
						Don’t have an account? <a href="#sign-up-dialog" class="access_link">Sign up</a>
					</div>
					<div class="tm-pv">
						<p>By Logging in, singing in or continuing, I agree to Yankit's <a href="{{ route('terms-condition') }}">Terms of Usa</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a></p>
					</div>
				</div>
			</form>
		</div>
		<div id="forgot-dialog" class="zoom-anim-dialog mfp-hide">
			<div class="small-dialog-header">
				<img src="{{ front_image('pop-logo.png') }}">
			</div>
			<form method="POST" action="{{ route('password.email') }}" class="form ajaxform">
				@csrf
				<div class="sign-in-wrapper">
				<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email" id="email_forgot" placeholder="Enter registered email">
						<p class="text-danger">Enter Email Address</p>
					</div>
				<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><button type="submit" class="btn_login">Reset Password</button></div>
				</div>
			</form>
		</div>
		<div id="user-type" class="zoom-anim-dialog mfp-hide">
			<div class="small-dialog-header"> <img src="{{ front_image('pop-logo.png') }}">
				<hr class="mb-1">
			</div>
			<form action="" id="social_form" class="form">
				<div class="sign-in-wrapper">
				<h3 class="mt-0 mb-3">You are a</h3>
				<label class="msh-radio">Sender
					<input type="radio" checked="checked" value="Sender" name="user_type">
					<span class="checkmark"></span> </label>
				<label class="msh-radio">Traveller
					<input type="radio" name="user_type" value="Traveller">
					<span class="checkmark"></span> </label>
				<div class="text-center"><button type="submit" class="btn_login mt-2">Continue</button></div>
				</div>
			</form>
		</div>
		<div id="sign-up-dialog" class="zoom-anim-dialog mfp-hide login">
			<div id="login">
				<div class="small-dialog-header small-gs">
					<img src="{{ front_image('pop-logo.png') }}">
					<h4>Welcome to Yankit </h4>
				</div>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-type="Sender" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Sender</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-type="Traveller" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Travler</a>
					</li>
				</ul>
				<div class="tab-content tab-content-gs" id="myTabContent">
					<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
						<form method="POST" action="{{ route('register') }}" class="form ajaxform ms-account-box" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="user_type" id="user_type" value="Sender" />
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="name" class=" form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" name="email" class=" form-control" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class=" form-control" id="password1" placeholder="Password">
							</div>
							<div class="form-group">
								<label>Confirm password</label>
								<input type="password" name="password_confirmation" class=" form-control" id="password2" placeholder="Confirm password">
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class=" form-control" placeholder="Address">
							</div>
							<div class="form-group">
								<div class="box">
									<div class="js--image-preview"></div>
									<div class="upload-options">
										<label>
										Upload ID
										<input type="file" name="avatar" class="image-upload" accept="image/*" />
										</label>
									</div>
								</div>
							</div>
							<div id="pass-info" class="clearfix"></div>
							<button class="btn_login">Create an account</button>
							<div class="text-center">
								Already a member? <a href="#sign-in-dialog" class="access_link">Sign in</a>
							</div>
						</form>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<form method="POST" action="{{ route('register') }}" class="form ajaxform ms-account-box" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="user_type" id="user_type" value="Traveller" />
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="name" class=" form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" name="email" class=" form-control" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class=" form-control" id="password1" placeholder="Password">
							</div>
							<div class="form-group">
								<label>Confirm password</label>
								<input type="password" name="password_confirmation" class=" form-control" id="password2" placeholder="Confirm password">
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class=" form-control" placeholder="Address">
							</div>
							<div class="form-group">
								<div class="box">
									<div class="js--image-preview"></div>
									<div class="upload-options">
										<label>
										Upload ID
										<input type="file" name="avatar" class="image-upload" accept="image/*" />
										</label>
									</div>
								</div>
							</div>
							<div id="pass-info" class="clearfix"></div>
							<button class="btn_login">Create an account</button>
							<div class="text-center">
								Already a member? <a href="#sign-in-dialog" class="access_link">Sign in</a>
							</div>
						</form>
					</div>
				</div>
				<button title="Close (Esc)" type="button" class="mfp-close"></button>
			</div>
		</div>
		<script src="{{ front_js('jquery-2.2.4.min.js') }}"></script>
		<script src="{{ front_js('common_scripts_min.js') }}"></script>
		<script src="{{ front_js('functions.js') }}"></script>
		<script src="{{ front_plugin('select2/select2.min.js') }}"></script>
		<script src="{{ front_plugin('sweetalert2/sweetalert2.all.min.js') }}"></script>
		<script src="{{ front_js('scripts.js') }}"></script>
		<script>$('input.date-pick').datepicker();</script>
		<script>
			function initMap() {
			  var input = document.getElementById('autocomplete');
			  var autocomplete = new google.maps.places.Autocomplete(input);
			 
			  autocomplete.addListener('place_changed', function() {
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			      window.alert("Autocomplete's returned place contains no geometry");
			      return;
			    }
			
			    var address = '';
			    if (place.address_components) {
			      address = [
			        (place.address_components[0] && place.address_components[0].short_name || ''),
			        (place.address_components[1] && place.address_components[1].short_name || ''),
			        (place.address_components[2] && place.address_components[2].short_name || '')
			      ].join(' ');
			    } 
			  });
			}
		</script>
		@yield('styles')
		@yield('scripts')
	</body>
</html>