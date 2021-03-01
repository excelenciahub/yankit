{!! Form::model($record, ['route' => ['admin.package.update', $record->id], 'method' => 'PATCH', 'novalidate' => 'novalidate', 'class'=>'validation']) !!}
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