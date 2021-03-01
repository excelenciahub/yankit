@extends('admin::layouts.master')
@section('title', 'Order')
@section('breadcrumb', 'Order')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="data-datatable table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">#No</th>
                            <th>Order No</th>
                            <th>Sender</th>
                            <th>Assigned To</th>
                            <th>Weight</th>
                            <th>Pickup Date</th>
                            <th>Pickup Time</th>
                            <th>Departure Airport</th>
                            <th>Destination Airport</th>
                            <th width="100px" class="text-center">Status</th>
                            <th width="100px" class="text-center">Payment Status</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key=>$val)
                            @php $status = $val->status=='Active'?'Inactive':'Active'; @endphp
                            <tr>
                                <td class="text-center">{!! $key + 1 !!}</td>
                                <td>{!! $val->order_no !!}</td>
                                <td>{!! $val->sender->name !!}</td>
                                <td>
                                    @if($val->journey)
                                        <button type="button" class="btn badge btn-success assign-order" data-title="Order: {{ $val->order_no }}" data-url="{{ route('admin.order.assign-order', $val->id) }}" data-modal="#order-assign-modal">{{ $val->journey->traveller->name }}</span>
                                    @else
                                        <button type="button" class="btn badge btn-warning assign-order" data-title="Order: {{ $val->order_no }}" data-url="{{ route('admin.order.assign-order', $val->id) }}" data-modal="#order-assign-modal">Assign Now</button>
                                    @endif
                                </td>
                                <td>{!! $val->weights !!}</td>
                                <td>{!! $val->pickup_date !!}</td>
                                <td>{!! $val->pickup_time !!}</td>
                                <td>{!! $val->departure_airport->name !!}</td>
                                <td>{!! $val->destination_airport->name !!}</td>
                                <td class="text-center"><span class="badge badge-{{ admin_status_color($val->status) }}">{!! $val->status !!}</span></td>
                                <td class="text-center"><span class="badge badge-{{ admin_status_color($val->payment_status) }}">{!! $val->payment_status !!}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.order.show', $val->id) }}" data-title="Order: {{ $val->order_no }}" data-modal="#order-show-modal" class="edit"><i class="fas fa-eye text-info"></i></a>&nbsp;
                                    <a href="{{ route('admin.order.destroy', $val->id) }}" class="delete"><i class="fas fa-trash-alt text-danger"></i></a>
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
<div class="modal fade" id="order-show-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="order-assign-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
