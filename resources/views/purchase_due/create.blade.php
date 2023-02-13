
<form class="mt-4" action="{{ route('purchase-due.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="date" class="col-sm-3 col-form-label text-end">Date </label>
            <div class="col-sm-9">
                <input type="date" id="date" name="date" class="form-control" placeholder="00.0" required>
            </div>
            </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end">Due Pay </label>
            <div class="col-sm-9">
                <input type="number" id="pay" name="pay" class="form-control" placeholder="00.0" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submit col-sm-2">Save</button>
            </div>
        </div>
    </div>

</form>
