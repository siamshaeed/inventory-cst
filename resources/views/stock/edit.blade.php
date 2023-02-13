
<form class="mt-4" action="{{ route('product.update', $product) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Category</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="category_id" class="form-control" required>
                    <option value="{{ $product->category->id }}" class="text-success" selected>{{ $product->category->name }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Product Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="Enter product name ..." required>
                <span class="text-warning">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Model Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="model" value="{{ old('model', $product->model) }}" class="form-control" placeholder="Enter model number ..." required>
                <span class="text-warning">{{ $errors->first('model') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Details</b></label>
            <div class="col-sm-9">
                <textarea name="details" class="form-control" cols="30" rows="6" placeholder="Write product details...">{{ old('details', $product->details) }}</textarea>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary modal_form_submit">Update</button>
            </div>
        </div>
    </div>

</form>
