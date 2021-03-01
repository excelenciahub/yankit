@extends('traveller::layouts.master')
@section('title', 'Journeys')
@section('content')
<main style="margin-top: 135px;">
        <div class="container margin_60">
            <div class="main_title">
               <h2>My Journey</h2>
            </div>
            @foreach($journeys as $key=>$val)
            <div class="row feature_home_2 gs-bg-style">
               <div class="col-md-6 ">
                  <div class="data-gs ">
                   <h4><strong>Requests ID</strong> <span>{{ $val->journey_no }} </span></h4>
                   <h4><strong>Item</strong> <span>{{ $val->price_with_symbol }} </span></h4>
                   <h5>Departure Airport </h5>
                   <p>{{ $val->departure_airport->address }}</p>
                   <h5>Destination Airport </h5>
                   <p>{{ $val->destination_airport->address }}</p>
                   <h5 style="margin-bottom: 18px;">Weight (kg) :<span> {{ $val->weight }} </span></h5>
                   <!-- <h5 style="margin-bottom: 18px;">What are you Sending :<span> Leptop</span></h5> -->
                   <h4><strong>Pickup Abailability</strong> <span>{{ $val->pickup_start_time.' - '.$val->pickup_end_time }}</span></h4>
                  </div>
               </div>
               <div class="col-md-6 ">
                <div class=" data-gs-2 text-right">
                    <h4><strong>Date :</strong> <span>{{ $val->journey_date }}</span></h4>
                    <h4 class="sts">Status : <span>{{ $val->status }}</span></h4>
                </div>
               </div>

               <div class="col-md-12">
					<hr>
					
               <h2 style="font-size: 22px; text-align: center"><strong>ORDERS</strong></h2>
						<hr>
           
                  @foreach($val->orders as $k=>$v)
				      <div class="strip_booking">
							<div class="row">
								<div class="col-lg-2 col-md-2">
									<h6><strong>Order</strong></h6>
									<p>#{{ $v->order_no }}</p>
								</div>
								<div class="col-lg-2 col-md-2">
									<h6><strong>WEIGHT</strong></h6>
									<p>{{ $v->weights }}</p>
								</div>
								<div class="col-lg-5 col-md-5">
									<h6><strong>ITEM</strong></h6>
									<p>{{ $v->descriptions }}</p>
								</div>
								
								<div class="col-lg-3 col-md-3">
									<div class="booking_buttons">
										<a href="#0" class="btn_2 disabled">{{ $v->status }}</a>
										
									</div>
								</div>
							</div>
							
						</div>
                  @endforeach
				</div>

            </div>
            @endforeach
            {{ $journeys->links() }}
         </div>
	</main>
@endsection
