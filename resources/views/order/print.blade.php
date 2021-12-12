<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sevenzero || Computer</title>
    <link rel="icon" href="{{ url('public/img/fave.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('public/fontawesome-free/css/all.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('public/css/master.css') }}" type="text/css">
    <script src="{{ url('public/js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/js/nl.js') }}" type="text/javascript"></script>

    <script>var url = (location.origin=="http://localhost") ? location.origin+"/"+location.pathname.split("/")[1]+"/": location.origin+"/";</script>
</head>

<body>
<style>
.alert-dismissible .close {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>




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
    .table th, .table td {
        padding: 5px 8px;
    }
</style>

<br>

<div>
    <div class="card" id="pring_body">
        <div class="card-body">
            <div class="beal_head">
                <div class="logo">
                    <img src="{{ url('public/img/fave.png') }}" alt="sevenzero">
                </div>
                <div class="head_a">
                    <h2 class="title">Shop name Shop name</h2>
                    <p class="slog">Build Up Your IT Career With Us</p>
                    <div class="col-md-7 addr">
                        <span>#shop</span>
                        <b>Address address address address.</b>
                        <p>Service Hotline# 01900-000000, 01200-101010</p>
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
                                {{ date('d-M-Y') }}
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
                            <tr>
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
                <strong>Address Address Address Address</strong>
                <br>
                <strong>E-mail: </strong>test@gmail.com
                <strong>Facebook: </strong>www.facebook.com
            </div>
        </div>
    </div>
</div>
    


<script>

window.print();

</script>

</body>

</html>

