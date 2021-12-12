

@extends('layout.app')

@section('master')


<div class="heading">
    <h2>All Servicing</h2>
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
        <h4>All servicing togather</h4>
        <p>You can edit and delete spacific servicing from hear</p>
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
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                        <th style="width:100px;">Delivary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicing as $key => $value)
                        @php
                            $customer = DB::table('customers')->where(['id'=>$value->customer_id])->get()->first();
                        @endphp
                        <tr class="sell_row" s_id="{{ $value->id }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                            <td>{{ $value->charge }}TK</td>
                            <td>{{ $value->paid }}TK</td>
                            <td>
                                @if ($value->charge - $value->paid == 0)
                                    <div class="badge badge-success">{{ $value->charge - $value->paid }}TK</div>
                                @else
                                    <div class="badge badge-danger">{{ $value->charge - $value->paid }}TK</div>
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
            {{ $servicing->links() }}
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




@endsection