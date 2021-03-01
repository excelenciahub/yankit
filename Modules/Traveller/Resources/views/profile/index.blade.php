@extends('sender::layouts.master')
@section('title', 'Profile')
@section('content')
<main style="margin-top: 135px;">
    <div class="margin_60 container">
    <div class="container">
        <div class="row gs-bg-style">
            <div class="col-lg-4">
                <div class="profile-card-4 z-depth-3">
                <div class="card">
                    <div class="card-body text-center bg-primary-gs rounded-top">
                        <div class="user-box">
                            <img src="{{ auth()->user()->avatar_url==''?front_image('avatar3.jpg'):auth()->user()->avatar_url }}" alt="user avatar">
                        </div>
                        <h5 class="mb-1 text-white">Jhon Doe</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group shadow-none">
                            <li class="list-group-item">
                            
                            <div class="list-details">
                                <small>Name</small>
                                <span>{{ auth()->user()->name }}</span>
                                
                            </div>
                            </li>
                            <li class="list-group-item">
                            
                            <div class="list-details">
                                <small>Email Address</small>
                                <span>{{ auth()->user()->email }}</span>
                                
                            </div>
                            </li>
                            <li class="list-group-item">
                            
                            <div class="list-details">
                                <small>Address</small>
                                <span>{{ auth()->user()->address }}</span>
                                
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card z-depth-3">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-primary nav-justified">
                        <li class="nav-item mb-3" >
                            <a href="javascript:void(0);" class="nav-link edit_profile"> <span class="hidden-xs">Edit</span></a>
                        </li>
                    </ul>
                    <div class="tab-pane" id="edit">
                        {{ Form::model($user, ['route'=>['traveller.profile.update', $user->id], 'method'=>'PATCH', 'class'=>'form ajaxform', 'id'=>'profile_form', 'files'=>true]) }}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"> Name</label>
                                <div class="col-lg-9">
                                {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Full name']) }}
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                {{ Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Email']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Change profile</label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="avatar" type="file">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                <div class="col-lg-9">
                                {{ Form::text('address', old('address'), ['class'=>'form-control', 'placeholder'=>'Address']) }}
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                <div class="col-lg-9">
                                {{ Form::text('username', old('username'), ['class'=>'form-control', 'placeholder'=>'Username']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                <div class="col-lg-9">
                                {{ Form::password('password', ['class'=>'form-control', 'id'=>'password', 'placeholder'=>'Password']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                <div class="col-lg-9">
                                {{ Form::password('password_confirmation', ['class'=>'form-control', 'id'=>'password_confirmation', 'placeholder'=>'Confirm Password']) }}
                                </div>
                            </div>
                            <div class="form-group row save_profile hide">
                                
                                <div class="col-lg-12">
                                    
                                    <input type="submit" class="btn_login-gs" value="Save Changes">
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
    </div>
</main>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#profile_form').find('input').prop('disabled', true);
            $(document).delegate('.edit_profile', 'click', function(){
                if($('.save_profile').hasClass('hide')){
                    $('.save_profile').removeClass('hide');
                    $('#profile_form').find('input').prop('disabled', false);
                    $(this).find('span').html('Cancel');
                }
                else{
                    $('.save_profile').addClass('hide');
                    $('#profile_form').find('input').prop('disabled', true);
                    $('#profile_form').trigger("reset");
                    $(this).find('span').html('Edit');
                }
            });
        });
    </script>
@endsection
