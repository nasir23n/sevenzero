
<form id="update_frm" action="{{ route('sell.update', $sell) }}" method="post" class="mt-5">
    @csrf
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="product_name">Product description</label>
                <textarea name="product_name" id="product_name" class="form-control" cols="30" rows="2" required>{{$sell->product_name}}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ $sell->unit_price }}" required> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="warranty">Warranty</label>
                <input type="text" name="warranty" id="warranty" class="form-control" value="{{ $sell->warranty }}"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $sell->quantity }}"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="discount">Discount par unit</label>
                <input type="number" name="discount" id="discount" value="{{ $sell->discount }}" class="form-control"> 
            </div>
        </div>
    </div>
</form>
<form id="delete_frm" action="{{ route('sell.delete', $sell) }}" method="post">
    @csrf
    @method('DELETE')
</form>
<div class="d-flex justify-content-between">
    <button class="btn bg-fave-gradient" id="update_sub">Update</button>
    <button class="btn btn-danger" id="delete_sub" onclick="$('#delete_frm').submit()">Delete this item</button>
</div>

<script>
$('#update_sub').click(function() {
    $("#update_frm").submit();
});
$('#delete_frm').submit(function() {
    if (window.confirm('Are you sure you want to delete this item?')) {
        return true;
    } else {
        return false;
    }
});
</script>