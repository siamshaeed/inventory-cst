
<form class="mt-4" action="{{ route('product.update', $product) }}" method="post" id="addFormData" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Product Name</b><span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="good_id" class="form-control" required>
                    <option value="{{ $product->good->id }}" class="text-success" selected>{{ $product->good->name }}</option>
                    @foreach($goods as $good)
                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('good_id') }}</span>
            </div>
        </div>
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
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Brand Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="brand_id" class="form-control" required>
                    <option value="{{ $product->brand->id }}" class="text-success" selected>{{ $product->brand->name }}</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('brand_id') }}</span>
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
            <label for="image" class="col-sm-3 col-form-label text-end"><b>Image</b></label>
            <div class="col-sm-9">
                <input type="file" name="image" value="{{ old('image', $product->image) }}" class="form-control" >
                {{-- Product Image Show --}}
                @if($product->image == 'blank_product.jpg')
                    <img src="{{ asset('images/product/logo/blank_product.jpg') }}" alt="product image" class="img-thumbnail mt-2" style="width: 90px; height: 60px">
                @else
                    <img src="{{ $product->image }}" alt="Logo" alt="product image" class="img-thumbnail mt-2" style="width: 90px; height: 60px">
                @endif

            </div>
        </div>

        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary modal_form_submit col-sm-2">Update</button>
            </div>
        </div>
    </div>

</form>

