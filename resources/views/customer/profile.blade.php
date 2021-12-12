

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
#profile_edit {
    margin-bottom: 10px;
    margin-left: auto;
    margin-top: -46px;
}
@media (max-width: 575px) {
    #profile_edit {
        margin-top: 10px;
        margin-left: 0;
    }
}
.p_t {
    display: table-cell;
}
.inp {
    display: none;
}
.editable .p_t {
    display: none;
}
.editable .inp {
    display: table-cell;
}
#edit_sub {
    display: none;
}
.editable #edit_sub {
    display: block;
}

.e {
    display: block;
    animation: zooms 0.2s ease-in-out;
}
.c {
    display: none;
    animation: zooms 0.2s ease-in-out;
}
@keyframes zooms {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
.edt .e {
    display: none;
}
.edt .c {
    display: block;
}
</style>
@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size:20px">×</span>
        </button>
        {{ session('status') }}
    </div>
@endif
<div class="card">
    <div class="card-header border-primary" style="border-top: 4px solid;border-bottom: 0;background:transparent;">
        <ul class="customer_tabs">
            <li><a href="{{ url('customer/'.$info->id.'/servicing') }}">Servicing</a></li>
            <li><a href="{{ url('customer/'.$info->id.'/sell') }}">Sell</a></li>
            <li><a class="active" href="{{ url('customer/'.$info->id.'/profile') }}">Profile</a></li>
        </ul>
    </div>
    <div class="card-body pt-0">
        <div class="d-flex">
            <button class="btn bg-fave-gradient d-flex align-items-center" id="profile_edit">
                <i class="fa fa-pencil-alt">&nbsp;&nbsp;</i>
                <span class="e">Edit profile</span>
                <span class="c">Cancel edit</span>
            </button>
        </div>
        <div class="table-responsive">
            <form id="profile_edit_form" action="{{ route('customer.update', $info) }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <td style="width:200px;"><strong>Name</strong></td>
                        <td class="p_t">{{ $info->name }}</td>
                        <td class="inp">
                            <input type="text" name="name" class="form-control" value="{{ $info->name }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;"><strong>Phone</strong></td>
                        <td class="p_t">{{ $info->phone }}</td>
                        <td class="inp">
                            <input type="text" name="phone" class="form-control" value="{{ $info->phone }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;"><strong>Address</strong></td>
                        <td class="p_t">{{ $info->address }}</td>
                        <td class="inp">
                            <input type="text" name="address" class="form-control" value="{{ $info->address}}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;"><strong>Email</strong></td>
                        <td class="p_t">{{ $info->email }}</td>
                        <td class="inp">
                            <input type="text" name="email"class="form-control" value="{{ $info->email }}">
                        </td>
                    </tr>
                </table>
                <button id="edit_sub" type="submit" class="btn bg-fave-gradient" disabled>Save</button>
            </form>
        </div>
    </div>
</div>


<script>
$('#profile_edit').click(function(e){
    e.preventDefault();
    $(this).toggleClass('edt');
    $('#profile_edit_form').toggleClass('editable');
});
$('#profile_edit_form').find('input').on('input', function() {
    $('#edit_sub').removeAttr('disabled');
});
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

</script>

@endsection