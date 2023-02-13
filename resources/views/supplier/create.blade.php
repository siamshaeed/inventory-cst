
<form class="mt-4" action="{{ route('supplier.store') }}" method="post" id="addFormData">
    @csrf

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Market Type</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="market_type_id" class="form-control" required>
                    <option value="">Select Market Type</option>
                    @foreach($marketTypes as $marketType)
                        <option value="{{ $marketType->id }}">{{ $marketType->name }}</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('market_type_id') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter supplier name" required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Title</b></label>
            <div class="col-sm-9">
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter title">
                <span class="text-warning">{{ $errors->first('title') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Phone Number</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="EX. 01 XXX XXX XXX" required>
                <span class="text-warning">{{ $errors->first('phone') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Address</b></label>
            <div class="col-sm-9">
                <textarea name="address" class="form-control" cols="30" rows="3" placeholder="Write address ...">{{ old('address') }}</textarea>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary modal_form_submit">Save</button>
            </div>
        </div>
    </div>

</form>
