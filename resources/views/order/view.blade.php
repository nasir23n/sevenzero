@extends('layout.app')

@section('master')

<style>
    .beal_head {
        position: relative;
        padding: 20px 10px;
        /* display: flex; */
        /* flex-direction: column; */
        align-items: center;
    }
    .head_a {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .logo {
        width: 120px;
        /* display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 20px; */
        position: absolute;
        left: 40px;
    }
    /* .logo img {
        width: 100px;
    } */
    .beal_head .title {
        text-align: center;
    }

    .beal_head .addr * {
        text-align: center;
    }
    .beal_head .slog {
        text-align: center;
        font-weight: bold;
        font-style: italic;
        font-size: 18px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        display: inline-block;
        margin: 0 auto;
    }

    .info_wrap {
        display: flex;
    }

    .customer_info {
        background: #f4f6f9;
        padding: 10px;
        width: 50%;
    }

    .customer_info ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .customer_info ul li {
        display: flex;
    }

    .customer_info ul li .nms {
        width: 110px;
        font-weight: bold;
    }

    .customer_info ul li .inf {
        flex: 1;
    }
    .bt {
        margin-top: 150px;
    }
    .bt strong {
        padding-top: 10px;
        border-top: 1px solid #333;
    }
    .turms {
        display: flex;
        flex-direction: column;
        padding: 10px;
        margin-top: 55px;
        font-size: 14px;
        font-weight: 500;
    }
    .turms * {
        text-align: center;
    }
    .add_foot {
        padding: 10px;
        text-align: center;
        font-size: 18px;
    }
    .print_ac {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f5f5f5;
        padding: 10px;
        border-radius: 5px;
    }

    .sell_row {
        transition: all 0.2s ease-in-out;
    }
    .sell_row:hover {
        background: #eeeeee;
        cursor: pointer;
    }
    
</style>

<br>
<div class="mb-2">
    <div class="print_ac">
        <button class="btn btn-success" id="back" s_id="{{ $info->id }}">
            <i class="fa fa-arrow-circle-left"></i>
            Back
        </button>
        <a href="{{ url('order/'.$order->id.'/print') }}" target="_blank" class="btn btn-success">
            <i class="fa fa-print"></i>
            Print
        </a>
        <button class="btn btn-success" id="add_product" s_id="{{ $order->id }}">
            <i class="fa fa-plus-circle"></i>
            Product
        </button>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:20px">×</span>
    </button>
    {{ session('success') }}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:20px">×</span>
    </button>
    {{ session('danger') }}
</div>
@endif
@if (session('product_add_status'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" style="font-size:20px">×</span>
    </button>
    {{ session('product_add_status') }}
</div>
@endif
<div class="mt-3">
    <div class="card" id="pring_body">
        <div class="card-body">
            <div class="beal_head">
                <div class="logo">
                    <img src="{{ asset('img/fave.png') }}" alt="sevenzero">
                </div>
                <div class="head_a">
                    <h2 class="title">Shop name Shop name</h2>
                    <p class="slog">Build Up Your IT Career With Us</p>
                    <div class="col-md-7 addr">
                        <span>#shop</span>
                        <b>as opposed to using 'Content here, content here', making it look like readable English.</b>
                        <p>Service Hotline# 01911-111111, 01500-000000</p>
                    </div>
                </div>
            </div>
            <div class="info_wrap">
                <div class="mr-2 customer_info">
                    <ul>
                        <li>
                            <div class="nms">Name:</div>
                            <div class="inf">{{ $info->name }}</div>
                        </li>
                        <li>
                            <div class="nms">Phone:</div>
                            <div class="inf">{{ $info->phone }}</div>
                        </li>
                        <li>
                            <div class="nms">Address:</div>
                            <div class="inf">{{ $info->address }}</div>
                        </li>
                        <li>
                            <div class="nms">Email:</div>
                            <div class="inf">{{ $info->email }}</div>
                        </li>
                    </ul>
                </div>
                <div class="ml-2 customer_info">
                    <ul>
                        <li>
                            <div class="nms">Date:</div>
                            <div class="inf">
                                {{ date('d-M-Y', strtotime($order->created_at)) }}
                            </div>
                        </li>
                        <li>
                            <div class="nms">Verifide By:</div>
                            <div class="inf">{{ $order->varifide_by }}</div>
                        </li>
                        <li>
                            <div class="nms">Order Id:</div>
                            <div class="inf">{{ $order->id }}</div>
                        </li>
                        <li>
                            <div class="nms">Refer By:</div>
                            <div class="inf">{{ $order->referrer }}</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/L</th>
                            <th>Product Description</th>
                            <th>Warranty</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $all_total = 0;
                        @endphp
                        @foreach($sell as $key => $value)
                            <tr class="sell_row" s_id="{{ $value->id }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->product_name }}</td>
                                <td>{{ $value->warranty }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>{{ $value->unit_price }}TK</td>
                                <td>{{ $value->discount }}TK</td>
                                <td>
                                    @php
                                        $this_total = ($value->unit_price - $value->discount) * $value->quantity;
                                        $all_total += $this_total;
                                    @endphp
                                    {{ $this_total }}TK
                                </td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <td colspan="6" class="text-center">
                                <strong>Discount togather</strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $order->combo_disc }}TK
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <strong>Grand Total (BDT)</strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $all_total - $order->combo_disc }}TK
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <strong>PAID</strong>
                            </td>
                            <td>
                                <strong class="d-flex align-items-center">
                                    @if(($all_total - $order->combo_disc) - $order->paid == 0)
                                        <span class="check mr-1"></span> {{ $order->paid }}TK
                                    @else
                                        <span class="check danger mr-1"></span> {{ $order->paid }}TK
                                    @endif
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex">
                    <strong> In Word Taka: </strong>
                    <span style="text-transform: capitalize;">&nbsp;{{ num_to_word($all_total - $order->combo_disc) }} Taka Only!</span>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="bt">
                            <strong>Received with good condition by</strong>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex">
                        <div class="bt ml-auto">
                            <strong>Authorized Signature and Company stamp</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="turms">
                <span>Warranty will be void if there is any physical damage,</span>
                <span>Burn issue &amp; Liquid damage to the product or warranty sticker</span>
                <span>is removed and sold goods are not refundable.</span>
                <span>please find out the BCS warranty policy.</span>
            </div>
            <div class="add_foot">
                <strong>Address</strong>
                <br>
                <strong>E-mail: </strong>email@gmail.com
                <strong>Facebook: </strong>www.facebook.com
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 mb-5">
    <div class="card-body">
        <form id="ss_frm" action="{{ route('order.update', $order) }}" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="paid">Paid</label>
                        <input type="text" name="paid" id="paid" class="form-control" value="{{ $order->paid }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="combo_disc">Discount togather</label>
                        <input type="text" name="combo_disc" id="combo_disc" class="form-control" value="{{ $order->combo_disc }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="referrer">Refer By</label>
                        <input type="text" name="referrer" id="referrer" class="form-control" value="{{ $order->referrer }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="varifide_by">Varifide By</label>
                        <input type="text" name="varifide_by" id="varifide_by" class="form-control" value="{{ $order->varifide_by }}"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" name="done" class="custom-control-input" id="done" @if($order->done == 1) checked @endif>
                            <label class="custom-control-label" for="done">Servicing complation status</label>
                        </div>
                    </div>
                </div>
            </div>
            <button id="sub" class="btn btn-success" type="submit" disabled>Save change</button>
        </form>
    </div>
</div>


<script>
$('#ss_frm').find('input').on('input', function() {
    $('#sub').removeAttr('disabled');
});
$('.sell_row').click(function(e){
    e.preventDefault();
    var s_id = $(this).attr('s_id');
    NL_Modal.open({
        title: 'Edit this product',
        preload: true,
        body: function(body_class, obj) {
            $.ajax({
                url: url + `sell/${s_id}/update`,
                methode: 'GET',
                success: function(data) {
                    body_class.html(data);
                }
            });
        }
    });
});

$('#back').click(function(){
    var attr = $(this).attr('s_id');
    window.location.href = url + `customer/${attr}/sell`;
});

$('#add_product').click(function(){
    var s_id = $(this).attr('s_id');
    NL_Modal.open({
        title: 'Add Product',
        preload: true,
        body: function(body_class, obj) {
            $.ajax({
                url: url + `sell/${s_id}/take`,
                methode: 'GET',
                success: function(data) {
                    body_class.html(data);
                }
            });
        }
    });
});


</script>

<style>
.danger_part {
    border: 3px solid #E91E63;
    /* border-radius: 0 !important; */
}
.danger_part .card-header {
    background: #E91E63;
    color: #ffffff;
    border-radius: 0 !important;
}
#delete_order_form {
    display: none;
}
.warn * {
    color: #E91E63;
    margin-bottom: 0;
}
</style>
<div class="card danger_part">
    <div class="card-header">
        <h4>Danger section</h4>
    </div>
    <div class="card-body text-center">
        <div class="warn">
            <h2>Be careful!</h2>
            <p class="text-danger">If you delete once a order, you will lose it parmanently form database.</p>
            <p class="text-danger">You never can't get back this data.</p>
            <p><strong class="text-danger">If you really want to delete this order, then click on the "get delete option" button bellow.</strong></p>
        </div>
        <button class="btn btn-danger mt-4" id="getDeleteOption">Get delete option</button>
        <form id="delete_order_form" action="{{ route('order.delete', $order) }}" method="post" class="justify-content-center">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-4" id="delete_s" disabled>Delete this order parmanently</button>
        </form>
    </div>
</div>

<script>

$('#getDeleteOption').click(function() {
    var $this = $(this);
    if (window.confirm('Are you sure you want to delete this?')) {
        $('#delete_order_form').addClass('d-flex');
        $this.addClass('d-none');
        $('#delete_s').removeAttr('disabled');
    }
});
$('#delete_order_form').submit(function(){
    if (window.confirm('Are you sure you want to delete this parmanently?')) {
        return true;
    } else {
        return false;
    }
});
</script>

@endsection