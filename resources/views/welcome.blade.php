@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<div id="search_container_2">
    <div id="search_2">
        <div class="wl-cs">
            <h1>Welocme to Yankit </h1>
            <p> Lorem Ipsum is simply dummy text of the printing<br> and typesetting industry</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wl-cs-gs">
                        <ul class="nav nav-tabs text-center">
                            <li><a href="#tours" data-toggle="tab" class="{{ auth()->user() && auth()->user()->user_type=='Traveller'?'':'active show' }}" ><span>Sender</span></a></li>
                            <li><a href="#hotels" data-toggle="tab" class="{{ auth()->user() && auth()->user()->user_type=='Traveller'?'active show':'' }}" ><span>Traveller</span></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ auth()->user() && auth()->user()->user_type=='Traveller'?'':'active show' }}" id="tours">
                            @if(isset($order))
                                {{ Form::model($order, ['route' => ['sender.cart.update', $order['id']], 'method' => 'PATCH', 'class'=>'form ajaxform', 'id'=>'order-form']) }}
                                {{ Form::hidden('item', $item) }}
                            @else
                                {{ Form::open(['route'=>'sender.cart.store', 'class'=>'form ajaxform', 'id'=>'order-form']) }}
                            @endif
                                <div class="row no-gutters custom-search-input-2">
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group">
                                            <p> Departure Airport</p>
                                            {{ Form::select('departure_airport_id',[''=>'Select Departure Airport']+$airports, old('departure_airport_id'), ['class'=>'form-control', 'id'=>'departure_airport_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group">
                                            <p> Destination Airport</p>
                                            {{ Form::select('destination_airport_id', [''=>'Select Destination Airport']+$airports, old('destination_airport_id'), ['class'=>'form-control', 'id'=>'destination_airport_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Journey Date</p>
                                            <!-- <input class="form-control booking_date" type="text" data-lang="en" data-large-mode="true" data-large-default="true" data-min-year="2017" data-max-year="2020" data-disabled-days="11/17/2017,12/17/2017" placeholder="Select Date"> -->
                                            <!-- <input class="date-pick form-control" data-date-format="dd-mm-yyyy" placeholder="Select Date" type="text"> -->
                                            {{ Form::text('pickup_date', old('pickup_date'), ['class'=>'date-pick form-control', 'id'=>'pickup_date', 'placeholder'=>'Select Date', 'data-date-format'=>'dd-mm-yyyy', 'readonly'=>true]) }}
                                            <i class="icon-calendar-7"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p> Receive Luggage Between</p>
                                            <!-- <input class="form-control booking_time" type="text" placeholder="Start Time" id="autocomplete"> -->
                                            {{ Form::text('pickup_start_time', old('pickup_start_time'), ['class'=>'form-control booking_time', 'placeholder'=>'Start Time']) }}
                                            <i class="icon-clock-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Receive Luggage Between</p>
                                            <!-- <input class="form-control booking_time" type="text" placeholder="Start Time" id="autocomplete"> -->
                                            {{ Form::text('pickup_end_time', old('pickup_end_time'), ['class'=>'form-control booking_time', 'placeholder'=>'End Time']) }}
                                            <i class="icon-clock-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Weight (kg)</p>
                                            <select class="form-control" name="items[1][weight]">
                                                <option value="" selected="">Select  Weight </option>
                                                @foreach($packages as $key=>$val)
                                                    <option {{ isset($order) && $order['items']['1']['weight']==$val->id?'selected="selected"':'' }} value="{{ $val->id }}">{{ $val->weight }} ({{ $val->price_with_symbol }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 p-1 mt-1">
                                        <div class="form-group">
                                        <p>What are you sending</p>
                                        {{ Form::text('items[1][description]', old('items.1.description'), ['class'=>'form-control ms-textarea', 'style'=>'resize: none;', 'placeholder'=>'Item description']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group ">
                                            <p>&nbsp;</p>
                                        <p><a href="javascript:void(0);" class="btn_search-gs mt-2 submit_ajaxform">Submit</a> </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane fade {{ auth()->user() && auth()->user()->user_type=='Traveller'?'active show':'' }}" id="hotels">
                            @if(isset($journey))
                                {{ Form::model($journey, ['route' => ['traveller.journey.update', $journey['id']], 'method' => 'PATCH', 'class'=>'form ajaxform', 'id'=>'order-form']) }}
                            @else
                                {{ Form::open(['route'=>'traveller.journey.store', 'class'=>'form ajaxform', 'id'=>'order-form']) }}
                            @endif
                                <div class="row no-gutters custom-search-input-2">
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group">
                                            <p> Departure Airport</p>
                                            {{ Form::select('departure_airport_id',[''=>'Select Departure Airport']+$airports, old('departure_airport_id'), ['class'=>'form-control', 'id'=>'departure_airport_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group">
                                            <p> Destination Airport</p>
                                            {{ Form::select('destination_airport_id', [''=>'Select Destination Airport']+$airports, old('destination_airport_id'), ['class'=>'form-control', 'id'=>'destination_airport_id']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Journey Date</p>
                                            <!-- <input class="form-control booking_date" type="text" data-lang="en" data-large-mode="true" data-large-default="true" data-min-year="2017" data-max-year="2020" data-disabled-days="11/17/2017,12/17/2017" placeholder="Select Date"> -->
                                            {{ Form::text('pickup_date', old('pickup_date'), ['class'=>'date-pick form-control', 'id'=>'pickup_date', 'placeholder'=>'Select Date', 'data-date-format'=>'dd-mm-yyyy', 'readonly'=>true]) }}
                                            <i class="icon-calendar-7"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p> Receive Luggage Between</p>
                                            <!-- <input class="form-control booking_time" type="text" placeholder="Start Time" id="autocomplete"> -->
                                            {{ Form::text('pickup_start_time', old('pickup_start_time'), ['class'=>'form-control booking_time', 'placeholder'=>'Start Time']) }}
                                            <i class="icon-clock-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Receive Luggage Between</p>
                                            <!-- <input class="form-control booking_time" type="text" placeholder="Start Time" id="autocomplete"> -->
                                            {{ Form::text('pickup_end_time', old('pickup_end_time'), ['class'=>'form-control booking_time', 'placeholder'=>'End Time']) }}
                                            <i class="icon-clock-4"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1 mt-1">
                                        <div class="form-group">
                                            <p>Weight (kg)</p>
                                            <select class="form-control" name="package_id">
                                                <option value="" selected="">Select  Weight </option>
                                                @foreach($packages as $key=>$val)
                                                    <option {{ isset($order) && $order['items']['1']['weight']==$val->id?'selected="selected"':'' }} value="{{ $val->id }}">{{ $val->weight }} ({{ $val->price_with_symbol }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                    </div>
                                    <div class="col-lg-4 p-1">
                                        <div class="form-group ">
                                            <p><a href="javascript:void(0);" class="btn_search-gs mt-4 submit_ajaxform">Add Journey</a> </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-1">
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main>
    <div class="white_bg">
        <div class="container margin_60">
        <div class="main_title">
            <h2>How It Work</h2>
        </div>
        <div class="row feature_home_2">
            <div class="col-md-3 text-center ">
            <div class="bg-style bg-style-gs mb-3"> <img src="{{ front_image('search2.png') }}" >
                <h3>Find</h3>
                <p>Find a destination to fly to within Australia</p>
            </div>
            </div>
            <div class="col-md-3 text-center ">
            <div class="bg-style mb-3"> <img src="{{ front_image('book.png') }}" >
                <h3>Book</h3>
                <p>Book your ticket and YANK extra bags with you</p>
            </div>
            </div>
            <div class="col-md-3 text-center ">
            <div class="bg-style mb-3"> <img src="{{ front_image('enjoy.png') }}" >
                <h3>Enjoy</h3>
                <p>Check-in your YANKIT bags and enjoy your flight</p>
            </div>
            </div>
            <div class="col-md-3 text-center ">
            <div class="bg-style mb-3"> <img src="{{ front_image('pay.png') }}" >
                <h3>Pay</h3>
                <p>Get paid upon landing at your destination airport</p>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class=" white_bg btm-sh">
        <div class="text-mbl"> <img src="{{ front_image('shap1.png') }}"> </div>
        <div class="container margin_60">
        <div class="row">
            <div class="col-lg-6 text-center">
            <div class="text-center mbl-img"> <img src="{{ front_image('about_app.png') }}" alt=""> </div>
            </div>
            <div class="col-lg-6">
            <div class="mbl-txt">
                <h2>HOW WE DO IT</h2>
                <p>The YANKIT promise is to deliver parcels faster, efficiently and cost-effectively across domestic and international borders and within a True 24 hours, ensuring that businesses are able to send to their customers with the confidence of fast and cheaper delivery. YANKIT does not just deliver parcels, we do it with your customers in mind.</p>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="container margin_60">
        <div class="row">
        <div class="col-lg-6">
            <div class="mbl-txt text-right mr-5 mbl-txt-gs mt-4">
            <h2>ABOUT US</h2>
            <p> YANKIT is an app-based solution enabling shippers to connect to YANKRs in a simple, easy-to-navigate mobile and web interfaces, in a cost-effective manner to move packages to their friends, families and consumers within a True 24 Hours. Logistics is handled through our broad network of YANKRs, airport hubs and ground transportation. </p>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <div class="text-center mbl-img"> <img src="{{ front_image('about.jpg') }}" alt=""> </div>
        </div>
        </div>
    </div>
    <div class="bg-container">
        <div class="container-fluid ">
        <div class="row">
            <div class="col-lg-6 ">
            <div class="mbl-img-g2 "> <img src="{{ front_image('mockup2.png') }}"> </div>
            </div>
            <div class="col-lg-6">
            <div class="mbl-txt  mr-5 mbl-txt-gs-1">
                <h2>Coming soon to<br>Android and iOS</h2>
                <span> <a href="#"><img src="{{ front_image('playstore.png') }}" alt=""></a></span> <span><a href="#"><img src="{{ front_image('ios.png') }}" alt=""> </a></span> </div>
            </div>
        </div>
        </div>
    </div>
    <div class="container margin_60">
    <div class="row">
        <div class="col-lg-6">
            <div class="mbl-txt  mr-5 main_title-gs">
                <h2>Contact US</h2>
                <p> For more information on business and individual shipping, or any other general question, please send us a message via the Contact Us form and we will get back to you with 24 hours.
                </p>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="bg-shape"> 
                <img src="{{ front_image('shap2.png') }}">
            </div>
            <div class="inner-gs ">
                {{ Form::open(['route'=>'customer-request', 'class'=>'form ajaxform', 'id'=>'request-form', 'novalidate'=>true]) }}
                    <label class="form-group">
                    <input type="text" class="form-control" name="name" required>
                    <span>Your Name</span>
                    <span class="border"></span>
                    </label>
                    <label class="form-group">
                    <input type="text" class="form-control" name="email" required>
                    <span for="">Your Mail</span>
                    <span class="border"></span>
                    </label>
                    <label class="form-group " >
                    <textarea rows="10" name="message" id="" class="form-control" required></textarea>
                    <span for="">Your Message</span>
                    <span class="border"></span>
                    </label>
                    <input type="submit" class="btn_search mt-4" value="Send Request">
                {{ Form::close() }}
            </div>
        </div>
    </div>
</main>
@endsection
