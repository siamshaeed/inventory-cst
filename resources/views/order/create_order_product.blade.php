
<form class="mt-4" action="{{ route('order.store') }}" method="post" id="addFormData">
    @csrf


    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-3">
                <b>Order Number</b> <span class="text-warning" title="Must be Required">*</span>
                <input type="text" id="order_number" name="order_number" value="{{ old('order_number') }}" class="form-control" placeholder="Enter order number ..." required>
                <span class="text-warning">{{ $errors->first('order_number') }}</span>
            </div>
            <div class="col-sm-3">
                <b>Order Date</b> <span class="text-warning" title="Must be Required">*</span>
                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>
            <div class="col-sm-3">
                <b>Customer</b><span class="text-warning" title="Must be Required">*</span>
                <select name="supplier_id" class="form-control" required>
                    <option value="">--Select Customer--</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }} - ({{ $supplier->market_type->name }})</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('supplier_id') }}</span>
            </div>
            <div class="col-sm-3">
                <b>Order Status</b><span class="text-warning" title="Must be Required">*</span>
                <select name="order_status" class="form-control" required>
                    <option value="">--Select Status--</option>
                    <option value="1" class="text-warning">Ordered</option>
                    <option value="2" class="text-danger">Pending</option>
                    <option value="3" class="text-success">Completed</option>
                </select>
                <span class="text-warning">{{ $errors->first('order_status') }}</span>
            </div>
        </div>
    </div>



    {{--<div class="container">
        <div class="row mb-3">
            <div class="col-sm-6">
                <select name="product_id" class="form-control" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ({{ $product->model }})</option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('supplier_id') }}</span>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary col-sm-12"><i class="fa fa-plus"></i> Add Product</button>
            </div>
        </div>
    </div>--}}



    <div class="container">
        <div class="row mb-3">

            <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <select name="product_id[]" class="form-control-" required>
                            <option value="">Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->good->name }} - ({{ $product->model }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" id="quantity" name="quantity[]" value="1" min="1" class="width-100" placeholder="0" required>
                    </td>
                    <td>
                        <input type="number" name="unit_price[]" placeholder="0.00" value="0" min="1" step="any" class="width-100" required>
                    </td>
                    <td>
                        <input type="number" name="discount[]" placeholder="0.00" value="0" class="width-100" required>
                    </td>
                    <td>
                        <input type="number" name="sub_total[]" placeholder="0.00" value="0" class="width-100" required>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>
                        <select name="product_id[]" class="form-control-" required>
                            <option value="">Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->good->name }} - ({{ $product->model }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" id="quantity" name="quantity[]" value="1" min="1" class="width-100" placeholder="0" required>
                    </td>
                    <td>
                        <input type="number" name="unit_price[]" placeholder="0.00" value="0" min="1" step="any" class="width-100" required>
                    </td>
                    <td>
                        <input type="number" name="discount[]" placeholder="0.00" value="0" class="width-100" required>
                    </td>
                    <td>
                        <input type="number" name="sub_total[]" placeholder="0.00" value="0" class="width-100" required>
                    </td>
                    <td></td>
                </tr>
                </tbody>

                <tfooter>
                    <tr>
                        <td colspan="5" class="text-end"><b>Grand Total = </b></td>
                        <td colspan="3">
                            <input type="number" name="grand_total">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Total Discount = </b></td>
                        <td colspan="3">
                            <input type="number" name="total_discount">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Total Amount = </b></td>
                        <td colspan="3">
                            <input type="number" name="total_amount">
                        </td>
                    </tr>
                </tfooter>
            </table>
            </div>

        </div>
    </div>



    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-4">
                <button class="btn btn-secondary col-sm-12">Save</button>
            </div>
        </div>
    </div>

</form>

@push('styles')
@endpush

@push('scripts')
@endpush
