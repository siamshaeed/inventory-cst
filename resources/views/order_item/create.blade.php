
<form class="mt-4" action="{{ route('order-item.store') }}" method="post" id="addFormData">
    @csrf

    <input type="hidden" name="order_id" value="{{ $order_id }}">

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Order Date</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Product Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="product_id" class="form-control" required>
                    <option value="">--Select Product--</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->good->name }} - ({{ $product->model }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Quantity</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control" placeholder="0" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Unit Price</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="unit_price" placeholder="0.00" value="0" min="1" step="any" class="form-control" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Discount</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="discount" value="0" min="0" step="any" class="form-control" placeholder="0.00" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Sub Total</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="sub_total" placeholder="0.00" value="0" class="form-control" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Status</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="item_status" class="form-control" required>
                    <option value="1" class="text-warning" selected>Ordered</option>
                    <option value="2" class="text-danger">Pending</option>
                    <option value="3" class="text-success">Completed</option>
                </select>
                <span class="text-warning">{{ $errors->first('order_status') }}</span>
            </div>
        </div>



        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submit modal_form_submit col-sm-4">Save</button>
            </div>
        </div>
    </div>

</form>
