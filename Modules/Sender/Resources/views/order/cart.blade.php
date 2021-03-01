@extends('sender::layouts.master')
@section('title', 'Cart')
@section('content')
<main style="margin-top: 135px;">
    @if(count($cart)==0)
    <div class="container margin_60">
        <div class="checkout-page">
            <div class="row gs-bg-style">
                <div class="col-lg-12 text-center">
                    <div class="modal-body">
                        
                        <div class="thank-you-pop">
                            <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                            <h1>Cart empty!</h1>
                            <p>Your cart is empty</p>
                            
                            
                            </div>
                            
                </div>
            </div>
        </div>
    </div>
    <!-- End Container -->
    @else
    {{ Form::open(['route'=>'sender.order.store', 'class'=>'form ajaxform', 'id'=>'order-form']) }}	
		<div class="container margin_60">
			<div class="checkout-page">
                @include('sender::layouts.message')
				<div class="row gs-bg-style">
					<div class="col-lg-12">
                        @php $currency_symbol = ''; @endphp
                        @if(count($cart)>0)
                            @foreach($cart as $key=>$val)
                                @php $currency_symbol = $val->attributes['currency_symbol']; @endphp
                                @php $cnt = 0; @endphp
                                @foreach($val->attributes->items as $k=>$item)
                                <div class="row pt-4 pb-4" style="border-bottom: 2px solid #d0d0d0;">
                                    <div class="col-md-6">
                                        <div class="data-gs ">
                                            <h4><strong>Item</strong> <span>{{ $item['package']->currency_symbol.''.$item['package']->price }}</span></h4>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="data-gs text-right">
                                            <h4><strong>Pickup Abailability</strong> <span>{{ $val->attributes->pickup_start_time.' - '.$val->attributes->pickup_end_time }}</span></h4>
                                        </div>
                                    </div> 
                                </div>
                                @endforeach
                                <div class="row pt-4 pb-4" >
                                    <div class="col-md-6">
                                        <div class="data-gs ">
                                            <h5>Departure Airport </h5>
                                            <p>{{ $val->attributes->departure_airport->address }}</p>
                                            <h5>Destination Airport </h5>
                                            <p>{{ $val->attributes->destination_airport->address }}</p>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="data-gs text-right">
                                            <h4><strong>Date :</strong> <span>{{ $val->attributes->pickup_date }}</span></h4>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row  pb-4 custom_address_box" > 
                                <div class="col-md-12">
                                <h5>Pick up address</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="data-gs ">
                                        <table class="table table-striped options_booking">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Please choose if pick up address is different
                                                </td>
                                                <td>
                                                    <label class="switch-light switch-ios pull-right">
                                                        <input type="checkbox" name="option_2" class="custom_address" value="Yes">
                                                        <span>
                                                        <span>No</span>
                                                        <span>Yes</span>
                                                        </span>
                                                        <a></a>
                                                    </label>
                                                </td>
                                            </tr>
                                    
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                    </div> 
                                    <div class="col-md-6">
                                    <div class="data-gs custom_address_input" style="display: none;">
                                        <textarea rows="2" id="message_contact" name="custom_address[{{$val->id}}]" class="form-control new_custom_address" data-id="{{$val->id}}" placeholder="Write your address" style="height:68px; resize: none"></textarea>
                                        </div>
                                    </div> 
                                </div>
                                @php $cnt = 0; @endphp
                                @foreach($val->attributes->items as $k=>$item)
                                <div class="row pt-4 pb-4 bg-edit" >
                                    <div class="col-md-6">
                                        <div class="data-gs ">
                                            <h5 style="margin-bottom: 18px;">Weight (kg) :<span> {{ $item['package']->weight }} </span></h5>
                                            <h5 style="margin-bottom: 18px;">What are you Sending :<span> {{ $item['description'] }}</span></h5>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="data-gs data-gs-icone text-right">
                                            <a href="{{ route('dashboard') }}?order={{$val->id}}&item={{ $k }}" class="ms-link"><i class="icon-pencil-7"> </i></a> <a href="{{ route('sender.cart.destroy', $val->id) }}?item={{ $k }}" class="ms-link delete"> <i class="icon-trash-7"> </i></a>
                                        </div>
                                    </div> 
                                </div>
                                @endforeach
                            @endforeach
                        @endif
                        <div class="row pt-4 pb-4 " >
                            <div class="col-md-6">
                                <div class="bd-dessess">
                                <div class="place-order " >	
                                    <div class="payment-options">
                                        <ul class="" >
                                            <li class="">
                                                <div class="radio-option">
                                                    <input type="radio" name="payment-group" checked="checked" id="payment-3">
                                                    <label for="payment-3"><img src="{{ front_image('Stripe.svg') }}" alt="">
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </div>
                              <div class="col-md-6">
                                <div class="bd-dessess price-gs">
                                    <p>Total </p><p class="text-right" style="float: right;">{{ $currency_symbol.''.$share_cart->getTotal }} </p>
                                </div>
                            </div> 
                    </div>
                     <div class="row pt-2 pb-2  " >
                        <div class="col-md-12 text-right">
                            <div class="checkboxes float-right mb-3 mt-3">
                                {{ Form::checkbox('terms', '1', old('terms'), ['id'=>'remember-me']) }}
                                <label for="remember-me">I accept <a href="{{ route('terms-condition') }}"> Terms & condition</a></label>
                             </div>
                          </div>  
                    </div>
                     <div class="row pt-1 pb-1  " >
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn_1 medium"><a href="javascript:void(0);" class="checkout">Pay Now</a></button>
                          </div>  
                    </div>
					</div>
				</div>
			</div>
		</div>
        <!-- End Container -->
        <input type="hidden" name="token" id="stripe_token" />
    {{ Form::close() }}
    @endif
</main>
@endsection
@section('scripts')
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var handler = StripeCheckout.configure({
            key:  "{{ config('services.stripe.public') }}",
            // image: "http://demo.satyamschool.in/yankit/public/images/favicon.png",
            locale: 'auto',
            token: function(token) {
                console.log(token);
                $('#stripe_token').val(JSON.stringify(token));
                $('#order-form.ajaxform').submit();
                // $('#preloader').show();
                // custom_address = [];
                // $('.new_custom_address').each(function(){
                //     console.log($(this).val());
                //     custom_address[$(this).data('id')] = $(this).val();
                // });
                // console.log(custom_address);
                // return;
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
                // $.ajax({
                //     type: 'post',
                //     data: {
                //         "_token": "{{ csrf_token() }}",
                //         "terms": 1,
                //         "custom_address": $('.new_custom_address').val(),
                //         token: token,
                //     },
                //     url: "{{ route('sender.order.store') }}",
                //     success:function(res){
                //         $('#preloader').hide();
                //         if(res.success===true){
                //             Swal.fire("Success!", res.message, "success").then(function (data) {
                //                 window.location.href = res.redirect;
                //             });
                //         }
                //         else{
                //             Swal.fire({
                //                 icon: 'error',
                //                 title: 'Oops...',
                //                 text: res.message,
                //             });
                //         }
                //     },
                //     error: function(reject) {
                //         $('#preloader').hide();
                //         var message = 'Something went wrong.';
                //         if (reject.status === 422) {
                //             var errors = $.parseJSON(reject.responseText);
                //             message = '';
                //             $.each(errors.errors, function (key, val) {
                //                 message += val[0] + '<br/>';
                //             });
                //         }
                //         else if (reject.status === 403) {
                //             message = $.parseJSON(reject.responseText).message;
                //         }
                //         Swal.fire("Oops...", message, 'error');
                //     }
                // });
            }
        });
        $(document).delegate('.checkout', 'click', function(e){
            e.preventDefault();
            var address = [];
            // $('#order-form.ajaxform').submit();

            if($('#remember-me').is(':checked')){
                handler.open({
                    name: "{{ config('app.name') }}",
                    description: '',
                    allowRememberMe: false,
                    amount: parseInt('{{ $share_cart->getTotal }}')*100,
                    currency: '{{ $share_cart->currency_code }}',
                    key: "{{ config('services.stripe.public') }}",
                });
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please accept terms and conditions!',
                });
            }
        });
    });
</script>
@endsection
