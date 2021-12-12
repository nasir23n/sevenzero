



<form action="{{ route('servicing.update', $servicing) }}" method="post" class="mt-5">
    @csrf 
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $servicing->title }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $servicing->description }}"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="charge">Charge</label>
                <input type="number" name="charge" id="charge" value="{{ $servicing->charge }}" class="form-control" required> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="paid">Paid in advance</label>
                <input type="number" name="paid" id="paid" value="{{ $servicing->paid }}" class="form-control" required> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" name="done" class="custom-control-input" id="done" @if($servicing->done == 1) checked @endif>
                    <label class="custom-control-label" for="done">Servicing complation status</label>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <button class="btn bg-fave-gradient" type="submit">Save</button>
        <button id="delete_parma" class="btn btn-danger ml-auto" type="submit">Delete parmanently</button>
    </div>
</form>

<form id="delete_form" action="{{ route('servicing.delete', $servicing) }}" method="post">
    @csrf
    @method('DELETE')
</form>

<script>
$('#delete_parma').click(function(e) {
    e.preventDefault();
    if (window.confirm('Are you sure you want to delete')) {
        $('#delete_form').submit();
    }
});

</script>