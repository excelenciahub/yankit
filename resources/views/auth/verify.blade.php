@extends('layouts.app')
@section('title', 'Verify Your Email Address')
@section('content')
<main style="margin-top: 135px;">
		<div class="container margin_60">
        <div class="checkout-page">
            <div class="row gs-bg-style">
                <div class="col-lg-12 text-center">
                    <div class="modal-body">
                    <form class="form ms-account-box" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="thank-you-pop">
                            <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                            <h1>Email <span>Verification</span></h1>
                            <span>Almost Done!</span>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p>{{ __('If you did not receive the email') }}, <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here') }}</button> to request another.</p>
                            
                            
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container -->
</main>
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv register-confirmationdv">
                    <form class="form ms-account-box" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <h3 class="log-title">Email <span>Verification</span></h3>
                        <span>Almost Done!</span>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p>{{ __('If you did not receive the email') }}, <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here') }}</button> to request another.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection
