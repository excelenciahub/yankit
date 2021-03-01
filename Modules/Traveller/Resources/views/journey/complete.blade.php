@extends('traveller::layouts.master')
@section('title', 'Order Completed')
@section('content')
<div class="page-title image-title" style="background-image:url({{ front_image('location-breadcrumb-bg.jpg') }});">
    <div class="container">
        <div class="page-title-wrap">
            <h2>Saving <span>Time, Trouble & Money</span> on couriers and shipping.</h2>
        </div>
    </div>
</div>
<div class="location-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="loginform-dv locaion-formdv">
                    <form class="form ms-account-box">							
                        <div class="succesfulplaceddv">
                            <img src="{{ front_image('succesful-place.png') }}">
                            <h2>SUCCESSFULLY CREATE</h2>
                            <p>You successfully created your journey, We will notify you if sender will matches with your journey details.</p>
                            <p>Please check <a href="{{ route('traveller.journey.index') }}">My Journey</a> for details.</p>
                        </div>							
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="location-back-btndv">
                                        <a href="{{ route('traveller.profile.index') }}" class="btn btn-dark">My Account</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="location-next-btndv">
                                        <a href="{{ route('traveller.index') }}" class="btn btn-dark">Back To Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
