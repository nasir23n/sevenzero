



<form action="{{ route('servicing.add', $info) }}" method="post" class="mt-5">
    @csrf
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Description"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="charge">Charge</label>
                <input type="number" name="charge" id="charge" placeholder="Charge" class="form-control" required> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="paid">Paid in advance</label>
                <input type="number" name="paid" id="paid" placeholder="Paid in advance" class="form-control" required> 
            </div>
        </div>
    </div>
    <button class="btn bg-fave-gradient" type="submit">Save</button>
</form>