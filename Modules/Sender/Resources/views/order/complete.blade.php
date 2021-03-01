@extends('sender::layouts.master')
@section('title', 'Order Completed')
@section('content')
<main style="margin-top: 135px;">
		<div class="container margin_60">
           
			<div class="checkout-page">
				<div class="row gs-bg-style">
					<div class="col-lg-12 text-center">
                        <div class="modal-body">
                           
                            <div class="thank-you-pop">
                                <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" width="80" alt="">
                                <h1>Thank You!</h1>
                                <p>Your submission is received and we will contact you soon</p>
                               <p align="center"><a class="btn_full_outline" href="{{ route('sender.order.index') }}" style="width: 250px;"> My Orders</a></p>
                                
                             </div>
                             
					</div>
				</div>
			</div>
		</div></div>
		<!-- End Container -->
	</main>
@endsection
