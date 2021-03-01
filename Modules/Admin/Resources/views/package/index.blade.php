@extends('admin::layouts.master')
@section('title', 'Package')
@section('breadcrumb', 'Package')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="header-title">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#package-modal"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
                <table class="data-datatable table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">#No</th>
                            <th>Weight</th>
                            <th>Price</th>
                            <th width="100px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key=>$val)
                            <tr>
                                <td class="text-center">{!! $key + 1 !!}</td>
                                <td>{!! $val->weight !!}</td>
                                <td>{!! $val->price_with_symbol !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.package.edit', $val->id) }}" data-modal="#package-edit-modal" class="edit"><i class="fas fa-edit text-info"></i></a>&nbsp;
                                    <a href="{{ route('admin.package.destroy', $val->id) }}" class="delete"><i class="fas fa-trash-alt text-danger"></i></a>
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
<div class="modal fade" id="package-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'admin.package.store', 'novalidate' => 'novalidate', 'class'=>'validation']) !!}
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        {{ Form::text('weight', old('weight'), ['class'=>'form-control', 'placeholder'=>'Enter weight', 'id'=>'weight', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid weight.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        {{ Form::text('price', old('price'), ['class'=>'form-control', 'placeholder'=>'Enter price', 'id'=>'price', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid price.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency_symbol">Currency Symbol</label>
                        {{ Form::text('currency_symbol', old('currency_symbol'), ['class'=>'form-control', 'placeholder'=>'Enter currency_symbol', 'id'=>'currency_symbol', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid currency_symbol.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency_code">Currency Code</label>
                        {{ Form::text('currency_code', old('currency_code'), ['class'=>'form-control', 'placeholder'=>'Enter currency_code', 'id'=>'currency_code', 'required'=>true]) }}
                        <div class="invalid-feedback">
                            Please provide valid currency_code.
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
<div class="modal fade" id="package-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
