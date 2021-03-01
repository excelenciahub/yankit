@extends('admin::layouts.master')
@section('title', 'Journey')
@section('breadcrumb', 'Journey')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="data-datatable table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">#No</th>
                            <th>Traveller</th>
                            <th>Departure Airport</th>
                            <th>Destination Airport</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th>Pickup Date</th>
                            <th>Pickup Time</th>
                            <th width="100px" class="text-center">Orders</th>
                            <!-- <th width="100px" class="text-center">Status</th> -->
                            <th width="100px" class="text-center">Payment Status</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key=>$val)
                            <tr>
                                <td class="text-center">{!! $key + 1 !!}</td>
                                <td>{!! $val->traveller->name !!}</td>
                                <td>{!! $val->departure_airport->name !!}</td>
                                <td>{!! $val->destination_airport->name !!}</td>
                                <td>{!! $val->weight !!}</td>
                                <td>{!! $val->price_with_symbol !!}</td>
                                <td>{!! $val->pickup_date !!}</td>
                                <td>{!! $val->pickup_time !!}</td>
                                <td width="100px" class="text-center">
                                    <button type="button" class="btn btn-success badge orders" data-url="{{ route('admin.journey.orders', $val->id) }}" data-title="{{ $val->traveller->name }}" data-modal="#journey-orders-modal">{!! count($val->orders) !!}</button>
                                </td>
                                <!-- <td class="text-center"><span class="badge badge-{{ admin_status_color($val->status) }}">{!! $val->status !!}</span></td> -->
                                <td class="text-center"><span class="badge badge-{{ admin_status_color($val->payment_status) }}">{!! $val->payment_status !!}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.journey.show', $val->id) }}" data-title="{{ $val->traveller->name }}" data-modal="#journey-show-modal" class="edit"><i class="fas fa-eye text-info"></i></a>&nbsp;
                                    <a href="{{ route('admin.journey.destroy', $val->id) }}" class="delete"><i class="fas fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
<!-- Modal -->
<div class="modal fade" id="journey-show-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Journey</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="journey-orders-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myOrderModalLabel">Journey</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
