
<form class="mt-4" action="{{ route('brand.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Brand Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter brand name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Company Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="company" name="company" value="{{ old('company') }}" class="form-control" placeholder="Enter company name" required>
                <span class="text-warning">{{ $errors->first('company') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Company Address</b></label>
            <div class="col-sm-9">
                <input type="text" id="company_address" name="company_address" value="{{ old('company_address') }}" class="form-control" placeholder="Enter company address">
                <span class="text-warning">{{ $errors->first('company_address') }}</span>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submitc modal_form_submit">Save</button>
            </div>
        </div>
    </div>

</form>
