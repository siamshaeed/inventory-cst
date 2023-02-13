
<form class="mt-4" action="{{ route('expense-category.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end">Expense <br> Category Name </label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter expense category name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submit">Submit</button>
            </div>
        </div>
    </div>

</form>
