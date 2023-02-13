
<form class="mt-4" action="{{ route('order.update', $order) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}

    <div class="col-md-10">
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Order Number </b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <input type="text" id="order_number" name="order_number" value="{{ $order->order_number }}" class="form-control" placeholder="Enter order number ..." required>
                <span class="text-warning">{{ $errors->first('order_number') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Order Date</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">

                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d', strtotime($order->date))) }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Customer</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="supplier_id" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        @if($supplier->id == $order->supplier_id)
                            <option value="{{ $order->supplier_id }}" class="text-warning" selected>{{ $order->supplier->name }}</option>
                        @else
                            <option value="{{ $supplier->id }}">{{ $supplier->name }} - ({{ $supplier->market_type->name }})</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('supplier_id') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Discount</b></label>
            <div class="col-sm-9">
                <input type="number" name="discount" value="{{ $order->total_discount }}" min="0" step="any" class="form-control" placeholder="00" required>
                <span class="text-warning">{{ $errors->first('discount') }}</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-3 col-form-label text-end"><b>Order Status</b> <span class="text-warning" title="Must be Required">*</span></label>
            <div class="col-sm-9">
                <select name="order_status" class="form-control" required>
                    @if($order->isRequest())
                        <option value="1" class="text-warning" selected>Ordered</option>
                        <option value="2" class="text-danger">Pending</option>
                        <option value="3" class="text-success">Completed</option>
                    @elseif($order->isPending())
                        <option value="2" class="text-danger" selected>Pending</option>
                        <option value="1" class="text-warning">Ordered</option>
                        <option value="3" class="text-success">Completed</option>
                    @elseif($order->isCompleted())
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
