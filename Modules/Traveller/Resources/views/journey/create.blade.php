@extends('traveller::layouts.master')
@section('title', 'Create Journey')
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
                    @if(isset($journey))
                        {{ Form::model($journey, ['route' => ['traveller.journey.update', $journey['id']], 'method' => 'PATCH', 'class'=>'form ms-account-box', 'id'=>'order-form']) }}
                        {{ Form::hidden('item', $item) }}
                    @else
                        {{ Form::open(['route'=>'traveller.journey.store', 'class'=>'form ms-account-box', 'id'=>'order-form']) }}
                    @endif
                        <div id="location_detail" class="order_box">
                            <h3 class="log-title">Location Details</h3>
                            @include('sender::layouts.message')
                            <div class="form-group">
                                <label for="departure_airport_id">Departure Airport<span class="req-star">*</span></label>
                                {{ Form::select('departure_airport_id', [''=>'Select Airport']+$airports, old('departure_airport_id'), ['class'=>'form-control select2', 'id'=>'departure_airport_id']) }}
                            </div>
                            <div class="form-group">
                                <label for="destination_airport_id">Destination (Drop off)<span class="req-star">*</span></label>
                                {{ Form::select('destination_airport_id', [''=>'Select Airport']+$airports, old('destination_airport_id'), ['class'=>'form-control select2', 'id'=>'destination_airport_id']) }}
                            </div>
                            <div class="form-group icon-sec">
                                <label for="pickup_date">Date<span class="req-star">*</span></label>
                                {{ Form::text('pickup_date', old('pickup_date'), ['class'=>'form-control pickup_date', 'id'=>'pickup_date', 'placeholder'=>'Pickup Date', 'readonly'=>true]) }}
                            </div>
                            <div class="form-group icon-sec">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12"><label>Pickup my luggage between</label></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="input-group bootstrap-timepicker timepicker">
                                            {{ Form::text('pickup_start_time', old('pickup_start_time'), ['class'=>'form-control input-small start_time', 'id'=>'pickup_start_time', 'readonly'=>true]) }}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="input-group bootstrap-timepicker timepicker">
                                            {{ Form::text('pickup_end_time', old('pickup_end_time'), ['class'=>'form-control input-small end_time', 'id'=>'pickup_end_time', 'readonly'=>true]) }}
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="location-next-btndv">
                                            <a href="javascript:void(0);" class="btn btn-dark btn-order-next">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="package_detail" class="order_box hide">
                            <h3 class="log-title">Package weight you carry on</h3>
                            <div class="items">
                                <div class="form-group">
                                    <label for="">Weight (kg)</label>
                                    <div class="package-weightsec">
                                        @foreach($packages as $key=>$val)
                                            <div class="rado-secdv weight_div">
                                                {{ Form::radio('package_id', $val->id, old('package_id'), ['class'=>'package_radio', 'id'=>'package_id_'.$val->id, 'data-id'=>$val->id]) }}
                                                <label for="package_id_{{ $val->id }}" data-id="{{ $val->id }}" class="package_radio_label">{{ $val->weight }} <span>({{ $val->traveller_price_with_symbol }})</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>							
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="location-back-btndv">
											<a href="javascript:void(0);" class="btn btn-dark btn-order-back">back</a>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="location-next-btndv">
											<a href="javascript:void(0);" onclick="document.getElementById('order-form').submit();" class="btn btn-dark">Submit</a>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
