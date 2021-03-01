{!! Form::model($record, ['route' => ['admin.airport.update', $record->id], 'method' => 'PATCH', 'novalidate' => 'novalidate', 'class'=>'validation']) !!}
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