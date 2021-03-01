@extends('traveller::layouts.master')
@section('title', 'Orders')
@section('content')
<div class="login-form-mainsec">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 col-sm-12">
                <div class="delivery-heading">
                    <h3>Delivery Requests - {{ $journey->pickup_date }}</h3>
                </div>
                <div class="loginform-dv delivery-requestdv">	
                    <div class="item-productshow">
                    <div class="detail-travler">
                        <ul>
                            <li><span><b>From: </b></span><span>{{ $journey->departure_airport->name }}</span></li>
                            <li><span><b>To: </b></span><span>{{ $journey->destination_airport->name }}</span></li>
                        </ul>
                        </div>
                        <ul>
                            @foreach($journey->orders as $key=>$val)
                                <li>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="profile-traver-img">
                                                <img src="{{ $val->sender->avatar_url==''?front_image('profilepic-dummy.png'):$val->sender->avatar_url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="detail-travler">
                                                <ul>
                                                    <li><span><b>Order No: </b></span><span>{{ $val->order_no }}</span></li>
                                                    <li><span><b>Name: </b></span><span>{{ $val->sender->name }}</span></li>
                                                    <li><span><b>Phone: </b></span><span>{{ $val->sender->phone }}</span></li>
                                                    <li><span><b>Pickup Time: </b></span><span>{{ $val->pickup_time }}</span> </li>
                                                    <li><span><b>Weight: </b></span><span>{{ $val->weights }}</span> </li>
                                                    <li><span><b>Price: </b></span><span>{{ $val->traveller_price_with_symbol }}</span> </li>
                                                </ul>
                                                <ul class="status-ul">
                                                    <li class="{{ strtolower($val->status) }}">{{ $val->status }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="total-amountsec text-center">
                                <h5>Total Amount</h5>
                                <h2>{{ $journey->total_price_with_symbol }}</h2>
                            </div>
                        </div>							
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection
