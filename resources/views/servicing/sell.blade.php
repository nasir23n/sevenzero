

@extends('layout.app')

@section('master')


<div class="heading">
    <h2>{{ $info->name }}'s information</h2>
</div>

<form id="sell_add_form" class="ml-2" action="{{ route('sell.add_new', $info) }}" method="post">
    @csrf
</form>
<div class="mb-3">
    <button id="ad_serv" c_id="{{ $info->id }}" class="btn btn-success">Add servicing</button>
    <button id="ad_sell" class="btn btn-success">Add sell</button>
</div>

<style type="text/css">

.customer_tabs {
    display: flex;
}
.customer_tabs li a:hover {
    background: #172364;
}
.customer_tabs li a {
    display: block;
    padding: 10px;
    border: 1px solid #5d6fd4;
    margin-left: -1px;
    background: #3345a9;
    color: #ffffff;
    transition: all 0.2s ease-in-out;
}
.customer_tabs li a.active {
    background: #5d6fd4;
    position: relative
}
.customer_tabs li a.active::before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-top: 15px solid #5d6fd4;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translate(-50%);
}
.sell_row {
    transition: all 0.2s ease-in-out;
}
.sell_row:hover {
    background: #eee;
    cursor: pointer;
}
</style>

<div class="card">
    <div class="card-header border-primary" style="border-top: 4px solid;border-bottom: 0;background:transparent;">
        <ul class="customer_tabs">
            <li><a href="{{ url('customer/'.$info->id.'/servicing') }}">Servicing</a></li>
            <li><a class="active" href="{{ url('customer/'.$info->id.'/sell') }}">Sell</a></li>
            <li><a href="{{ url('customer/'.$info->id.'/profile') }}">Profile</a></li>
        </ul>
    </div>
    <div class="card-body pt-0">
        @if(session('servicing_add'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button>
                {{ session('servicing_add') }}
            </div>
        @endif
        @if(session('sell_delete'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button>
                {{ session('sell_delete') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 80px;">S/L</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                        <th style="width:100px;">Delivary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $value)    
                        @php
                            $sell = $value->sell;
                            $sell_total = 0;
                            foreach ($sell as $index => $item) {
                                $sell_total += ($item->unit_price - $item->discount) * $item->quantity;
                            }
                        @endphp
                        <tr class="sell_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>{{ $sell_total - $value->combo_disc }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                            <td>
                                @if (($sell_total - $value->combo_disc) - $value->paid == 0)
                                    <div class="badge badge-success">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @else
                                    <div class="badge badge-danger">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @endif
                            </td>
                            {{-- {{ $sell_total - $value->paid }}TK --}}
                            <td>
                                @if($value->done == 1)
                                    <div class="badge badge-success">OK</div>
                                @else
                                    <div class="badge badge-danger">Painding</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




<script>
$('#ad_sell').click(function(e){
    e.preventDefault();
    if (window.confirm('Are you sure you want to add a new sell to this customer?')) {
        $('#sell_add_form').submit();
    }
});
$('#ad_serv').click(function(){
    var c_id = $(this).attr('c_id'); 
    NL_Modal.open({
        title: 'Add Servicing',
        preload: true,
        body: function(body_class, obj){
            $.ajax({
                url: url + `servicing/${c_id}/add_servicing`,
                method: 'GET',
                success: function(data) {
                    body_class.html(data);
                }
            });
        }
    });
});

$('.sell_row').click(function() {
    var attr = $(this).attr('s_id');
    window.location.href = url + `order/${attr}/view`;
});


</script>




@endsection