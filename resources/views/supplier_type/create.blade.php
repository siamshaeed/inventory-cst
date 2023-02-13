
<form class="mt-4" action="{{ route('brand.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end">Supplier-Type Name </label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Brand Name ..." required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end">Supplier-Type Title </label>
            <div class="col-sm-9">
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Title Name ...">
                <span class="text-warning">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end">Supplier-Type Address</label>
            <div class="col-sm-9">
                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter Supplier Type Address ...">
                <span class="text-warning">{{ $errors->first('address') }}</span>
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
