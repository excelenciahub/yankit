@extends('layouts.app')
@section('title', 'Abou Us')
@section('content')
<main style="margin-top: 135px;">
    <div class="container margin_60">
        <div class="row gs-bg-style">
            <div class="col-md-8">
                <div class="form_title">
                    <h3><strong><i class="icon-pencil"></i></strong>Fill the form below</h3>
                    <p>
                        Mussum ipsum cacilds, vidis litro abertis.
                    </p>
                </div>
                <div class="step">

                    <div id="message-contact"></div>
                    {{ Form::open(['route'=>'contact-us.store', 'class'=>'form ajaxform', 'id'=>'contact-form', 'novalidate'=>true]) }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="name_contact" name="first_name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" id="lastname_contact" name="last_name" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email_contact" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" id="phone_contact" name="phone" class="form-control" placeholder="Enter Phone number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="5" id="message_contact" name="message" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                
                                <input type="submit" value="Submit" class="btn_1" id="submit-contact">
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            

            <div class="col-md-4">
                <div class="box_style_1">
                    <span class="tape"></span>
                    <h4>Address <span><i class="icon-pin pull-right"></i></span></h4>
                    <p>
                        Place Charles de Gaulle, 75008 Paris
                    </p>
                    <hr>
                    <h4>Help center <span><i class="icon-help pull-right"></i></span></h4>
                    <p>
                        Lorem ipsum dolor sit amet, vim id accusata sensibus, id ridens quaeque qui. Ne qui vocent ornatus molestie.
                    </p>
                    <ul id="contact-info">
                        <li>+ 61 (2) 8093 3400 / + 61 (2) 8093 3402</li>
                        <li><a href="#">info@domain.com</a>
                        </li>
                    </ul>
                </div>
                <div class="box_style_4">
                    <i class="icon_set_1_icon-57"></i>
                    <h4>Need <span>Help?</span></h4>
                    <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                    <small>Monday to Friday 9.00am - 7.30pm</small>
                </div>
            </div>
            
        </div>
        
    </div>
</main>
@endsection
