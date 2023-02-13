
<form class="mt-4" action="{{ route('order-item.update', $orderItem) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">

        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Order Date</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="date" id="date" name="date" value="{{ $orderItem->date }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Product Name</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="product_id" class="form-control" required>
                    @foreach($products as $product)
                        @if($orderItem->product_id == $product->id)
                            <option value="{{ $orderItem->product_id }}" selected>{{ $product->good->name }} - ({{ $product->model }})</option>
                        @else
                            <option value="{{ $product->id }}">{{ $product->good->name }} - ({{ $product->model }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Quantity</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" id="quantity" name="quantity" value="{{ $orderItem->quantity }}" min="1" class="form-control" placeholder="0" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Unit Price</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="unit_price" value="{{ $orderItem->unit_price }}" min="1" step="any" class="form-control" placeholder="0.00" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Discount</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="discount" value="{{ $orderItem->discount }}" min="0" step="any" class="form-control" placeholder="0.00" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Sub Total</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="number" name="sub_total" value="{{ $orderItem->sub_total }}" class="form-control" placeholder="0.00" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Status</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="item_status" class="form-control" required>
                    @if($orderItem->isRequest())
                        <option value="1" class="text-warning" selected>Ordered</option>
                        <option value="2" class="text-danger">Pending</option>
                        <option value="3" class="text-success">Completed</option>
                    @elseif($orderItem->isPending())
                        <option value="2" class="text-danger" selected>Pending</option>
                        <option value="1" class="text-warning">Ordered</option>
                        <option value="3" class="text-success">Completed</option>
                    @elseif($orderItem->isCompleted())
                        <option value="3" class="text-success" selected>Completed</option>
                        <option value="1" class="text-warning">Ordered</option>
                        <option value="2" class="text-danger">Pending</option>
                    @endif
                </select>
                <span class="text-warning">{{ $errors->first('order_status') }}</span>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="submit" class="col-sm-3 col-form-label text-end"></label>
            <div class="col-sm-9">
                <button class="btn btn-secondary btn-submit modal_form_submit">Update</button>
            </div>
        </div>
    </div>

</form>
