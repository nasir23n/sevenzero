@extends('layout.app')

@section('master')

<div class="heading">
    <h2>All Customer</h2>
</div>
<style type="text/css">
    .customer_row {
        transition: all 0.3s ease-in-out;
    }

    .customer_row:hover {
        cursor: pointer;
        background: #eee;
    }
    .customer_row.hovered {
        background: #eee;
    }
    
</style>

<div class="card">
    <div class="card-header">
        All new customer
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 80px;">S/L</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $key => $value): ?>
                <tr class="customer_row" sid="<?php echo $value->id; ?>">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->address }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ date('d-M-Y' ,strtotime($value->created_at->toDateString())) }}</td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>
</div>


<script type="text/javascript">
$('.customer_row').click(function() {
    var sid = $(this).attr('sid');
    window.location.href = url + 'customer/' + sid + '/servicing';
});

$('.customer_row').contextmenu(function(e){
    e.preventDefault();
    var sid = $(e.currentTarget).attr('sid');
    $(this).addClass('hovered');
    if ($('#context').length > 0) {
        $('#context').remove();
    }
    $('body').prepend(`<ul class="context" id="context">
                            <li><a class="servicing" href="javascript:void(0)"><i class="fa fa-cogs"></i>Servicing</a></li>
                            <li><a class="sell" href="javascript:void(0)"><i class="fa fa-shopping-bag"></i>Sell</a></li>
                            <li><a class="profile" href="javascript:void(0)"><i class="fa fa-user"></i>Profile</a></li>
                        </ul>`);
    var clientX = e.clientX;
    var clientY = e.clientY;
    var w_width = $(window).width();
    var w_height = $(window).height();
    var h = $('#context').height();
    var w = $('#context').width(); 
    if (clientX + w > w_width) {
        clientX = w_width - w - 10;
    }
    if (clientY + h > w_height) {
        clientY = w_height - h - 10;
    }
    $('#context').css({
        'display': 'block',
        'top': clientY,
        'left': clientX
    });
    $('.context').contextmenu(function(e) {
        e.preventDefault();
    });


    $('#context a').click(function(e) { 
        e.preventDefault();
        if ($(this).hasClass('servicing')) {
            window.location.href = url + 'customer/' + sid + '/servicing';
        }
        if ($(this).hasClass('sell')) {
            window.location.href = url + 'customer/' + sid + '/sell';
        }
        if ($(this).hasClass('profile')) {
            window.location.href = url + 'customer/' + sid + '/profile';
        }
    });
});
// customer/2/servicing
$(window).keydown(function(e) {
    if (e.key == "Escape") {
        $('.context').remove();
        $('.customer_row').removeClass('hovered');
    }
});

$(window).scroll(function(){
    $('.context').remove();
    $('.customer_row').removeClass('hovered');
});
$(window).click(function(){
    $('.context').remove();
    $('.customer_row').removeClass('hovered');
});
</script>

@endsection
