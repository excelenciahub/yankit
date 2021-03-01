<div class="table-responsive">
    <table class="table table-striped dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th class="text-center" width="60px">#</th>
                <th>Order No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Package Weight</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journey->orders as $key=>$val)
                <tr>
                    <td class="text-center">{{$key+1}}</td>
                    <td>{{ $val->order_no }}</td>
                    <td>{{ $val->sender->name }}</td>
                    <td>{{ $val->sender->email }}</td>
                    <td>{{ $val->sender->phone }}</td>
                    <td>{{ $val->pickup_date }}</td>
                    <td>{{ $val->pickup_time }}</td>
                    <td>{{ $val->weights }}</td>
                    <td>{{ $val->price_with_symbol }}</td>
                </tr>
            @endforeach
            @if(count($journey->orders)==0)
                <tr>
                    <td colspan="9">
                        <div class="alert alert-warning">Orders not found!</div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="text-right">
    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">
        <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span> Close
    </button>
</div>