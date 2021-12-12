

<form action="{{ route('sell.add', $order) }}" method="post" class="mt-5">
    @csrf
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="product_name">Product description</label>
                <textarea name="product_name" id="product_name" class="form-control" cols="30" rows="2" required></textarea>
                {{-- <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product description"> --}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price" required> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="warranty">Warranty</label>
                <input type="text" name="warranty" id="warranty" class="form-control" placeholder="Warranty"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="discount">Discount par unit</label>
                <input type="number" name="discount" id="discount" placeholder="Discount par unit" class="form-control"> 
            </div>
        </div>
    </div>
    <button class="btn bg-fave-gradient" type="submit">Add</button>
</form>