{!! Form::model($record, ['route' => ['admin.order.assign-order', $record->id], 'method' => 'PATCH', 'novalidate' => 'novalidate', 'class'=>'validation']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Departure Airport</label>
                <div>{{ $record->departure_airport->address }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Destination (Drop off)</label>
                <div>{{ $record->destination_airport->address }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-danger">
                <label>Custom pick up address</label>
                <div>{{ $record->custom_address }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Pickup Date</label>
                <div>{{ $record->pickup_date }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Pickup my luggage between</label>
                <div>{{ $record->pickup_time }}</div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Weight</label>
        <div>{{ $record->weights }}</div>
    </div>
    <div class="radio radio-info mb-2">
        {{ Form::radio('journey_id', '', $record->journey_id=='', ['id'=>'radio0']) }}
        <label for="radio0" class="text-danger">Unassign Order</label>
    </div>
    <div class="form-group">
        {{ Form::text('comments[0]', $record->journey_comment?$record->journey_comment->comment:'', ['class'=>'form-control', 'placeholder'=>'Comment']) }}
    </div>
    <div class="table-responsive">
        <table class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th class="text-center" width="60px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Pickup Time</th>
                    <th>Package Weight</th>
                </tr>
            </thead>
            <tbody>
                @foreach($journey as $key=>$val)
                    <tr>
                        <td class="text-center">
                            <div class="radio radio-info">
                                {{ Form::radio('journey_id', $val->id, $record->journey_id, ['id'=>'radio'.$val->id]) }}
                                <label for="radio{{ $val->id }}">&nbsp;</label>
                            </div>
                        </td>
                        <td><label for="radio{{ $val->id }}">{{ $val->traveller->name }}</label></td>
                        <td>{{ $val->traveller->email }}</td>
                        <td>{{ $val->traveller->phone }}</td>
                        <td>{{ $val->pickup_time }}</td>
                        <td>{{ $val->weight }} ({{ $val->price_with_symbol }})</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            @php
                                $comment = $val->getOrderComment($record->id);
                            @endphp
                            {{ Form::text('comments['.$val->id.']', $comment?$comment->comment:'', ['class'=>'form-control', 'placeholder'=>'Comment']) }}
                        </td>
                    </tr>
                @endforeach
                @if(count($journey)==0)
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-warning">Matching journey not found!</div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <span class="btn-label"><i class="mdi mdi-check-all"></i></span> Save
        </button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">
            <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span> Cancel
        </button>
    </div>
{!! Form::close() !!}