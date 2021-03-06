{!! Form::model($record, ['route' => ['admin.journey.update', $record->id], 'method' => 'PATCH', 'novalidate' => 'novalidate', 'class'=>'validation', 'id'=> 'jouryney-form']) !!}
    <div class="form-group">
        <label for="departure_airport_id">Departure Airport</label>
        <div class="form-group">
            {{ Form::select('departure_airport_id', [''=>'Select Airport']+$airports, old('departure_airport_id'), ['class'=>'form-control', 'data-toggle'=>'select2', 'id'=>'departure_airport_id']) }}
        </div>
        <div class="invalid-feedback">
            Please provide valid note.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group">
        <label for="destination_airport_id">Destination (Drop off)</label>
        <div class="form-group">
            {{ Form::select('destination_airport_id', [''=>'Select Airport']+$airports, old('destination_airport_id'), ['class'=>'form-control', 'data-toggle'=>'select2', 'id'=>'destination_airport_id']) }}
        </div>
        <div class="invalid-feedback">
            Please provide valid note.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group icon-sec">
        <label for="pickup_date">Pickup Date</label>
        {{ Form::text('pickup_date', old('pickup_date'), ['class'=>'form-control pickup_date', 'id'=>'pickup_date', 'placeholder'=>'Pickup Date', 'readonly'=>true]) }}
    </div>
    <div class="form-group icon-sec">
        <div class="row">
            <div class="col-md-12 col-sm-12"><label>Pickup my luggage between</label></div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="input-group bootstrap-timepicker timepicker">
                    {{ Form::text('pickup_start_time', old('pickup_start_time'), ['class'=>'form-control flatpickr-input', 'id'=>'pickup-start-time', 'readonly'=>true]) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="input-group bootstrap-timepicker timepicker">
                    {{ Form::text('pickup_end_time', old('pickup_end_time'), ['class'=>'form-control flatpickr-input', 'id'=>'pickup-end-time', 'readonly'=>true]) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="">Weight (kg)</label>
        <div class="package-weightsec">
            {{ Form::select('package_id', [''=>'Select Weight']+$packages, old('package_id'), ['class'=>'form-control', 'data-toggle'=>'select2', 'id'=>'package_id']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="name">Description</label>
        {{ Form::textarea('description', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter description', 'id'=>'description', 'rows'=>'5']) }}
        <div class="invalid-feedback">
            Please provide valid description.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group">
        <label for="">Payment</label>
        <div class="package-weightsec">
            {{ Form::select('payment_status', [''=>'Select Status']+payment_status(), old('payment_status'), ['class'=>'form-control', 'data-toggle'=>'select2', 'id'=>'payment_status']) }}
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
