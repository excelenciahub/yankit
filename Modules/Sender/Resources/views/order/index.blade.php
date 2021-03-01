@extends('sender::layouts.master')
@section('title', 'Orders')
@section('content')
<main style="margin-top: 135px;">
	
        <div class="container margin_60">
            <div class="main_title">
               <h2>My Requests</h2>
            </div>
            @foreach($orders as $key=>$val)
             <div class="row feature_home_2 gs-bg-style">
                <div class="col-md-6 ">
                   <div class="data-gs ">
                    <h4><strong>Requests ID</strong> <span>{{ $val->order_no }} </span></h4>
                    @foreach($val->items as $k=>$v)
                        <h4><strong>Item</strong> <span>{{ $v->price_with_symbol }} </span></h4>
                    @endforeach
                    <h5>Departure Airport </h5>
                    <p>{{ $val->departure_airport->address }}</p>
                    <h5>Destination Airport </h5>
                    <p>{{ $val->destination_airport->address }}</p>
                    @foreach($val->items as $k=>$v)
                    <h5 style="margin-bottom: 18px;">Weight (kg) :<span> {{ $v->weight }} </span></h5>
                    <h5 style="margin-bottom: 18px;">What are you Sending :<span> {{ $v->description }}</span></h5>
                    <h4><strong>Pickup Abailability</strong> <span>{{ $val->pickup_start_time.' - '.$val->pickup_end_time }}</span></h4>
                    @endforeach
                   </div>
                </div>
                <div class="col-md-6 ">
                 <div class=" data-gs-2 text-right">
                     <h4><strong>Date :</strong> <span>{{ $val->order_date }}</span></h4>
                     <h4 class="sts">Status : <span class="{{ strtolower($val->status) }}">{{ $val->status }}</span></h4>
                 </div>
              </div>
             </div>
             @endforeach
             {{ $orders->links() }}
         </div>
		
	</main>
@endsection
