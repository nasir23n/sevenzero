<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sevenzero || Computer</title>
    <link rel="icon" href="{{ asset('img/fave.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}" type="text/css">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/nl.js') }}" type="text/javascript"></script>

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
    <div class="main_wrap">
        <div class="aside" id="aside">
            <a href="{{ url('/') }}" class="aside_top">
                SEVENZERO
            </a>
            <div class="aside_fixed_part">
                <div class="aside_profile">
                    <div class="profile_image">
                        <img src="{{ asset('img/fave.png') }}" alt="U">
                    </div>
                    <div class="info">
                        <h4 class="name">Sevenzero</h4>
                        <p>test@gmail.com</p>
                    </div>
                </div>
                <ul class="aside_links">
                    <li><a class="@if(isset($deshboard_active)) {{ $deshboard_active }} @endif" href="{{ url('/') }}">Deshboard</a></li>
                    <li class="aside_drop">
                        <a href="javascript:void(0)" class="aside_drop_btn @if(isset($customer_active)) {{ $customer_active }}@endif">Customer</a>
                        <ul>
                            <li><a class="@if(isset($customer_add_active)) {{ $customer_add_active }} @endif" href="{{ url('customer/add') }}">Add</a></li>
                            <li><a class="@if(isset($customer_all_active)) {{ $customer_all_active }} @endif" href="{{ url('customer/all') }}">ALL</a></li>
                        </ul>
                    </li>
                    <li><a class="@if(isset($servicing_active)) {{ $servicing_active }} @endif" href="{{ url('servicing/all_togather') }}">All servicing</a></li>
                    <li><a class="@if(isset($sell_active)) {{ $sell_active }} @endif" href="{{ url('sell/all_togather') }}">All sell</a></li>
                </ul>
            </div>
        </div>
        <div class="content_wrap">
            <div class="top_nav">
                <button class="top_nav_toggle" id="nav_toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a href="{{ url('/') }}" class="hidden_home">SEVENZERO</a>
                <div>
                    {{-- top nav --}}
                </div>
            </div>
            <div class="main_content">
                @yield('master')
            </div>
        </div>
    </div>

    <script>
        $('.aside_drop_btn').click(function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active'); 
            } else {
                $('.aside_drop_btn').each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                    }
                });
                $(this).addClass('active');
            }
        });

        $('#nav_toggle').click(function() {
            $(this).toggleClass('active');
            $('.top_nav').toggleClass('active');
            $('.content_wrap').toggleClass('active');
            $('#aside').toggleClass('active');
        });

    </script>
</body>

</html>
