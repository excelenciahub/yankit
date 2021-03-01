@extends('admin::layouts.master')
@section('title', 'Airport')
@section('breadcrumb', 'Airport')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#airport-modal"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
                <table class="data-datatable table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">#No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key=>$val)
                            <tr>
                                <td class="text-center">{!! $key + 1 !!}</td>
                                <td>{!! $val->name !!}</td>
                                <td>{!! $val->address !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.airport.edit', $val->id) }}" data-modal="#airport-edit-modal" class="edit"><i class="fas fa-edit text-info"></i></a>&nbsp;
                                    <a href="{{ route('admin.airport.destroy', $val->id) }}" class="delete"><i class="fas fa-trash-alt text-danger"></i></a>
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
<div class="modal fade" id="airport-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Airport</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'admin.airport.store', 'novalidate' => 'novalidate', 'class'=>'validation']) !!}
                    <div class="form-group">
                        <label for="name">Name</label>
                        {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter name', 'id'=>'name', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid name.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        {{ Form::textarea('address', old('address'), ['class'=>'form-control', 'placeholder'=>'Enter address', 'id'=>'address', 'rows'=>'3', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid address.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span> Save
                        </button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">
                            <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span> Cancel
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="airport-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Airport</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
