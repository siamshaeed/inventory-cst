
<form class="mt-4" action="{{ route('brand.update', $brand) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Brand Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ $brand->name }}" class="form-control" placeholder="Enter brand name ..." required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Company Name</b></label>
            <div class="col-sm-9">
                <input type="text" id="company" name="company" value="{{ $brand->company }}" class="form-control" placeholder="Enter company name ...">
                <span class="text-warning">{{ $errors->first('company') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Company Address</b></label>
            <div class="col-sm-9">
                <input type="text" id="company_address" name="company_address" value="{{ $brand->company_address }}" class="form-control" placeholder="Enter company address ...">
                <span class="text-warning">{{ $errors->first('company_address') }}</span>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submitc modal_form_submit">Update</button>
            </div>
        </div>
    </div>

</form>
