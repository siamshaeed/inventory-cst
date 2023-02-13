<form class="mt-4" action="{{ route('expense.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">

        <div class="mb-3 row">
            <label for="category_id" class="col-sm-4 col-form-label text-end"><b>Expense Category</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-8">
                <div class="form-check form-switch p-0">
                    <select name="category_id" class="form-control" required>
                        <option value=""> Select Expense Category </option>
                        @foreach ($expence_categorys as $expence_category)
                            <option value="{{ $expence_category->id }}"> {{ $expence_category->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date" class="col-sm-4 col-form-label text-end"><b>Date</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-8">
                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <input type="hidden" id="user_id" name="user_id" >
            </div>
        </div>

        <div class="mb-3 row">
            <label for="title" class="col-sm-4 col-form-label text-end"><b>Title</b></label>
            <div class="col-sm-8">
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter expense title">
                <span class="text-warning">{{ $errors->first('title') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="amount" class="col-sm-4 col-form-label text-end"><b>Amount</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-8">
                <input type="number" step="any" id="amount" min="0" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Enter expense amount" required>
                <span class="text-warning">{{ $errors->first('amount') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="submit" class="col-sm-4 col-form-label text-end"></label>
            <div class="col-sm-8">
                <button class="btn btn-secondary btn-submit">Submit</button>
            </div>
        </div>

    </div>

</form>
