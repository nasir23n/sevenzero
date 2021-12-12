

@extends('layout.app')

@section('master')


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
.servicing_row {
    transition: all 0.2s ease-in-out;
}
.servicing_row:hover {
    background: #eee;
    cursor: pointer;
}
.check_op {
    display: flex;
    align-items: center;
}
.check_op span {
    margin-right: 10px;
}
</style>

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

<div class="card">
    <div class="card-header border-primary" style="border-top: 4px solid;border-bottom: 0;background:transparent;">
        <ul class="customer_tabs">
            <li><a class="active" href="{{ url('customer/'.$info->id.'/servicing') }}">Servicing</a></li>
            <li><a href="{{ url('customer/'.$info->id.'/sell') }}">Sell</a></li>
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
        @if(session('servicing_update'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button>
                {{ session('servicing_update') }}
            </div>
        @endif
        @if(session('servicing_delete'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button>
                {{ session('servicing_delete') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 80px;">S/L</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th style="width:100px;">Payment</th>
                        <th style="width:100px;">Delivary</th>
                        <th>Charge</th>
                        <th>Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_charge = 0;
                        $total_paid = 0;
                    @endphp
                    @foreach ($servicing as $key => $value)    
                        <tr class="servicing_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>
                                @if($value->charge > $value->paid)
                                    <div class="badge badge-danger">Remaining</div>
                                @elseif($value->charge < $value->paid)
                                    <div class="badge badge-warning">Over</div>
                                @else
                                    <div class="badge badge-success">Ok</div>
                                @endif
                            </td>
                            <td>
                                @if($value->done == 1)
                                    <div class="badge badge-success">Done</div>
                                @else
                                    <div class="badge badge-warning">Painding</div>
                                @endif
                            </td>
                            <td>{{ $value->charge }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                        </tr>
                        @php
                            $total_charge += $value->charge;
                            $total_paid += $value->paid;
                        @endphp
                    @endforeach
                    @if($servicing->count() > 0)
                        <tr>
                            <td colspan="6">Total</td>
                            <td>{{ $total_charge }}TK</td>
                            <td>{{ $total_paid }}TK</td>
                        </tr>
                        <tr>
                            <td colspan="6">Remaining</td>
                            <td colspan="2">
                                <div class="check_op">
                                    @if($total_charge == $total_paid)
                                        <span class="check"></span>{{ $total_charge - $total_paid }}TK
                                    @else
                                        <span class="check danger"></span>{{ $total_charge - $total_paid }}TK
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
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
$('.servicing_row').click(function(e){
    e.preventDefault();
    var s_id = $(this).attr('s_id');
    NL_Modal.open({
        title: 'Servicing details',
        preload: true,
        body: function(body_class, obj) {
            $.ajax({
                url: url + `servicing/${s_id}/servicing_details`,
                method: 'GET',
                success: function(data) {
                    body_class.html(data);
                }
            })
        }
    });
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
})

</script>




@endsection