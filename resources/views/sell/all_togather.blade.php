

@extends('layout.app')

@section('master')


<div class="heading">
    <h2>All Sell</h2>
</div>
<style>
.sell_row {
    transition: all 0.2s ease-in-out;
}
.sell_row:hover {
    background: #eee;
    cursor: pointer;
}
</style>

<div class="card">
    <div class="card-header">
        <h4>All sell togather</h4>
        <p>You can go spacific sell voucher by clicking that row</p>
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
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                        <th style="width:100px;">Delivary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $value)    
                        @php
                            $customer = DB::table('customers')->where(['id'=>$value->customer_id])->get()->first();
                            $sell = DB::table('sells')->where(['order_id'=>$value->id])->get();
                            $sell_total = 0;
                            foreach ($sell as $index => $item) {
                                $sell_total += ($item->unit_price - $item->discount) * $item->quantity;
                            }
                        @endphp
                        <tr class="sell_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>{{ $sell_total - $value->combo_disc }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                            <td>
                                @if(($sell_total - $value->combo_disc) - $value->paid == 0)
                                    <div class="badge badge-success">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @else
                                    <div class="badge badge-danger">{{ ($sell_total - $value->combo_disc) - $value->paid }}TK</div>
                                @endif
                            </td>
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
        {{ $orders->links() }}
    </div>
</div>




<script>
$('.sell_row').click(function() {
    var s_id = $(this).attr('s_id');
    window.location.href = url + `order/${s_id}/view`;
});
</script>




@endsection