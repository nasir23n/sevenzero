
@extends('layout.app')


@section('master')
    
<link rel="stylesheet" href="{{ url('public/css/deshboard/deshboard.css') }}">
<div class="heading">
    <h2>Deshboard</h2>
</div>

<style>
.deshboard_wrap {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 15px;
    margin-bottom: 20px;
}
@media (max-width: 1100px) {
    .deshboard_wrap {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .deshboard_wrap {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 450px) {
    .deshboard_wrap {
        grid-template-columns: repeat(1, 1fr);
    }
}
.deshboard_wrap .card-body * {
    color: #ffffff;
}
.df {
    padding: 0;
}
.df a {
    display: block;
    padding: 10px;
    color: #ffffff;
    text-align: center;
}
.sell_row, .order_row {
    transition: all 0.2s ease-in-out;
}
.order_row:hover,
.sell_row:hover {
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
<div class="deshboard_wrap">
    <div class="card bg-fave-gradient shadow">
        <div class="card-body">
            <p>Total customer</p>
            <strong>{{ $customer->count() }} customers</strong>
        </div>
        <div class="card-footer df">
            <a href="{{ url('customer/all') }}">All customer  &nbsp;<i class="fa fa-arrow-circle-right"></i> </a>
        </div>
    </div>
    <div class="card bg-primary shadow">
        <div class="card-body">
            <p>Total servicing</p>
            <strong>
                @php
                    $charge = 0;
                    foreach($servicing as $value) {
                        $charge += $value->charge;
                    }
                    echo $charge;
                @endphp
                TK
            </strong>
        </div>
        <div class="card-footer df">
            <a href="{{ url('servicing/all_togather') }}">All servicing  &nbsp;<i class="fa fa-arrow-circle-right"></i> </a>
        </div>
    </div>
    <div class="card bg-success shadow">
        <div class="card-body">
            <p>Total sell</p>
            <strong>
                @php
                    $total_sell = 0;
                    $total_paid = 0;
                    $combo_disc = 0;
                    foreach ($order as $value) {
                        $total_paid += $value->paid;
                        $combo_disc += $value->combo_disc;
                        $sell = DB::table('sells')->where(['order_id' => $value->id])->get();
                        foreach ($sell as $spc) {
                            $total_sell += ($spc->unit_price - $spc->discount) * $spc->quantity;
                        }
                    }
                    echo $total_sell - $combo_disc;
                @endphp
                TK
            </strong>
        </div>
        <div class="card-footer df">
            <a href="{{ url('sell/all_togather') }}">All sell &nbsp;<i class="fa fa-arrow-circle-right"></i> </a>
        </div>
    </div>
    <div class="card bg-secondary shadow">
        <div class="card-body">
            <p>Total sell this month</p>
            <strong id="total_sell_this_mounth"></strong>
        </div>
        <div class="card-footer df">
            <a href="{{ url('sell/all_togather') }}">All sell &nbsp;<i class="fa fa-arrow-circle-right"></i> </a>
        </div>
    </div>
</div>



<div class="card">
    <div class="card-header">
        <h4>Servicing this month</h4>
    </div>
    <div class="card-body">
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
                        <th>Customer</th>
                        <th>phone</th>
                        <th>Date</th>
                        <th style="width:100px;">Delivary</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_charge_week = 0;
                        $total_paid_week = 0;
                    @endphp
                    @foreach ($servicing_this_month as $key => $value)
                        @php
                            $customer = DB::table('customers')->where(['id'=>$value->customer_id])->get()->first();
                        @endphp
                        <tr class="sell_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>
                                @if($value->done == 1)
                                    <div class="badge badge-success">OK</div>
                                @else
                                    <div class="badge badge-danger">Painding</div>
                                @endif
                            </td>
                            <td>{{ $value->charge }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                            <td>
                                @if ($value->charge - $value->paid == 0)
                                    <div class="badge badge-success">{{ $value->charge - $value->paid }}TK</div>
                                @else
                                    <div class="badge badge-danger">{{ $value->charge - $value->paid }}TK</div>
                                @endif
                            </td>
                        </tr>
                        @php
                            $total_charge_week += $value->charge;
                            $total_paid_week += $value->paid;
                        @endphp
                    @endforeach
                    @if(count($servicing_this_month) > 0)
                        <tr>
                            <td colspan="5">Total</td>
                            <td>{{ $total_charge_week }}TK</td>
                            <td>{{ $total_paid_week }}TK</td>
                            <td>
                                <div class="check_op">
                                    @if($total_charge_week == $total_paid_week)
                                        <span class="check"></span>{{ $total_charge_week - $total_paid_week }}TK
                                    @else
                                        <span class="check danger"></span>{{ $total_charge_week - $total_paid_week }}TK
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
// servicing_details
$('.sell_row').click(function() {
    var s_id = $(this).attr('s_id');
    NL_Modal.open({
        title: 'Servicing details',
        preload: true,
        body: function(body_class, Obj) {
            $.ajax({
                method: 'GET',
                url: url + `servicing/${s_id}/servicing_details`,
                success: function(data) {
                    body_class.html(data);
                }
            });
        }
    });
});

</script>


<div class="card mt-5">
    <div class="card-header">
        <h4>Sell this month</h4>
    </div>
    <div class="card-body">
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
                        <th>Customer</th>
                        <th>Date</th>
                        <th style="width:100px;">Delivary</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_sell_this_month = 0;
                        $total_paid_this_month = 0;
                        $total_remaining_this_month = 0;
                    @endphp
                    @foreach ($sell_this_month as $key => $value)    
                        @php
                            $customer = DB::table('customers')->where(['id'=>$value->customer_id])->get()->first();
                            $sell = DB::table('sells')->where(['order_id'=>$value->id])->get();
                            $sell_total = 0;
                            foreach ($sell as $index => $item) {
                                $sell_total += ($item->unit_price - $item->discount) * $item->quantity;
                            }
                        @endphp
                        <tr class="order_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>
                                @if($value->done == 1)
                                    <div class="badge badge-success">OK</div>
                                @else
                                    <div class="badge badge-danger">Painding</div>
                                @endif
                            </td>
                            <td>{{ $sell_total - $value->combo_disc }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                            <td>
                                @php
                                    $total_remaining_this_month += ($sell_total - $value->combo_disc) - $value->paid;
                                    $total_paid_this_month += $value->paid;
                                    $total_sell_this_month += $sell_total - $value->combo_disc;
                                @endphp
                                @if(($sell_total - $value->combo_disc) - $value->paid == 0)
                                    <div class="badge badge-success">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @else
                                    <div class="badge badge-danger">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(count($sell_this_month) > 0)    
                        <tr>
                            <td colspan="4">Total sell</td>
                            <td id="smtt">{{ $total_sell_this_month }}TK</td>
                            <td>{{ $total_paid_this_month }}TK</td>
                            <td>
                                <div class="check_op">
                                    @if($total_sell_this_month - $total_paid_this_month == 0)
                                        <span class="check"></span>{{ $total_sell_this_month - $total_paid_this_month }}TK
                                    @else
                                        <span class="check danger"></span>{{ $total_sell_this_month - $total_paid_this_month }}TK
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
$('.order_row').click(function() {
    var s_id = $(this).attr('s_id');
    window.location.href = url + `order/${s_id}/view`;
});
$('#total_sell_this_mounth').html($('#smtt').html());
</script>
@endsection