@extends('admin::layouts.master')
@section('title', 'Traveller')
@section('breadcrumb', 'Traveller')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="data-datatable table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">#No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="100px" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key=>$val)
                            @php $status = $val->status=='Active'?'Inactive':'Active'; @endphp
                            <tr>
                                <td class="text-center">{!! $key + 1 !!}</td>
                                <td>{!! $val->name !!}</td>
                                <td>{!! $val->email !!}</td>
                                <td>{!! $val->phone !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs status {{ $val->status=='Active'?'btn-success':'btn-warning' }}" href="{{ route('admin.traveller.update', $val->id) }}" data-status="{{ $status }}">{{ $val->status }}</a>
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
@endsection
