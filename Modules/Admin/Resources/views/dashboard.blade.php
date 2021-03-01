@extends('admin::layouts.master')
@section('title', 'Dashbaord')
@section('breadcrumb', 'Dashbaord')
@section('content')
<div class="row">
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.airport.index') }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-server font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{ $statistics['airports'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Airports</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.package.index') }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-package font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['packages'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Packages</p>
                            </div>
                        </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.traveller.index') }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-globe font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['travellers'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Travellers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.sender.index') }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-send font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['senders'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Senders</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
</div>
<!-- end row-->
<div class="row">
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.order.index', array('status' => 'Pending')) }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-map font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{ $statistics['pending_orders'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Pending Order</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.order.index', array('status' => 'Picked Up')) }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-upload-cloud font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['picked_up_orders'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Picked Up Order</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.order.index', array('status' => 'Delivered')) }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-check-square font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['delivered_orders'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Delivered Order</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
    <div class="col-md-6 col-xl-3">
        <a href="{{ route('admin.order.index', array('status' => 'Cancelled')) }}">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                            <i class="fe-alert-triangle font-22 avatar-title text-danger"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $statistics['cancelled_orders'] }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Cancelled Order</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </a>
    </div> <!-- end col-->
</div>
<!-- end row-->
@endsection
