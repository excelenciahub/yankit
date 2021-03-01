@extends('layouts.app')
@section('title', 'Abou Us')
@section('content')
<main style="margin-top: 135px;">
	
        <div class="container margin_60">
            <div class="main_title">
               <h2>About</h2>
            </div>
            <div class="row feature_home_2 gs-bg-style">
               <div class="col-md-12 ">
                  <div class="about_new">
                    <div class="about_top">
                        <h3 class="title" style="color: #333">Air travel is expensive. But it should not be.</h3>

                        <h4 class="mb-3 text-center text-md-left">Our business model is easily scalable across regions with travelers recovering a portion of their flight costs via Yankit</h4>
                      
                        <div class="row mt-5">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ front_image('pay.png') }}" class="img-fluid w-25 mb-3" alt="">
                                        <h4 class="text-center">Value for money</h4>
                                        <p>The value creation for economy class
                                            travelers are enormous as those flying
                                            would recover some of their ticket
                                            costs by yanking a bag for a fee.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ front_image('sale.png') }}" class="img-fluid w-25 mb-3" alt="">
                                        <h4 class="text-center">Mailing at a fraction</h4>
                                        <p>Senders (individuals and businesses)
                                            will find it affordable to send all types
                                            of parcels via Yankit rather than using
                                            expensive couriers that take longer and
                                            cost more. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{ front_image('speed.png') }}" class="img-fluid w-25 mb-3" alt="">
                                        <h4 class="text-center">Scaling at speed</h4>
                                        <p>The model enables the replication of
                                            Yankit hubs for logistical purposes
                                            across different regions and airports
                                            while maintaining standards.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                   <hr>
					  <div class="row mt-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <img src="{{ front_image('about.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-6">
								
								<div class="main_title">
               <h2>WHAT WE SOLVE</h2>
            </div>
                                <h4 style="line-height: 28px;">On many international flights, passenger-allocated baggage
                                    space in the cargo haul is often under-utilized or sold by airlines
                                    to large third party freight companies.</h4>
								
								<ul class="list_ok">
										<li style="line-height: 28px;">International flights allocate passengers allowable
                                        baggage space split in reasonable baggage but travelers
                                        often carry no more than one bag each time, giving up
                                        crucial space that is often under-utilized, or is sold by the
                                        airlines to freight companies such as DHL, FedEx and
                                        others.</li>
										<li style="line-height: 28px;">Businesses such as international shipping companies,
                                        fashion outlets, and online pharmacies are often
                                        overcharged by freight companies, with two additional
                                        problems of delay and customs.</li>
										
									</ul>
                                
                            </div>
                        </div>
                </div>
               </div>
            </div>
         </div>
		
	</main>
@endsection
