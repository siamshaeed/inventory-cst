<form class="mt-4" action="{{ route('purchase.store') }}" method="post" id="addFormData">
    @csrf


    <div class="container">

        <div class="row mb-3">

            <div class="col-sm-3">
                <b>Invoice Number</b> <span class="text-warning" title="Must be Required">*</span>
                <input type="text" id="invoice" name="invoice" value="{{ old('invoice') }}" class="form-control"
                       placeholder="Enter invoice number ..." required>
                <span class="text-warning">{{ $errors->first('invoice') }}</span>
            </div>

            <div class="col-sm-3">
                <b>Purchase Date</b> <span class="text-warning" title="Must be Required">*</span>
                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control" required>
                <span class="text-warning">{{ $errors->first('date') }}</span>
            </div>

            <div class="col-sm-3">
                <b>Supplier</b>
                <span class="text-warning" title="Must be Required">*</span>
                <select name="supplier_id" class="form-control" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }} - ({{ $supplier->market_type->name }})
                        </option>
                    @endforeach
                </select>
                <span class="text-warning">{{ $errors->first('supplier_id') }}</span>
            </div>

            <div class="col-sm-3">
                <b>Purchase Status</b>
                <span class="text-warning" title="Must be Required">*</span>
                <select name="purchase_status_type" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="1" class="text-warning">Ordered</option>
                    <option value="2" class="text-danger">Pending</option>
                    <option value="3" class="text-success">Received</option>
                </select>
                <span class="text-warning">{{ $errors->first('purchase_status_type') }}</span>
            </div>

        </div>

    </div>


    <div class="container">

        <div class="row mb-3">

            <div class="col-md-12">

                <button type="button"
                        class="btn btn-primary btn-datatable-row-action add_product"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Add Product" style="float: right">
                    <i class="fa fa-plus"></i> Add Product
                </button>
            </div>

        </div>

    </div>


    <div class="container">

        <div class="row mb-3">

            <div class="table-responsive purchase_table">

                <table class="table table-striped">

                    <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Discount (Amount)</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Action</th>
                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <th scope="row">1</th>

                        <td>
                            <select name="product_id[]"
                                    class="form-select" required>

                                <option value="">Product</option>

                                @foreach($products as $product)

                                    <option value="{{ $product->id }}">{{ $product->good->name }}
                                        - ({{ $product->model }})
                                    </option>

                                @endforeach

                            </select>
                        </td>

                        <td>
                            <input type="number"
                                   id="invoice"
                                   name="quantity[]"
                                   value="1"
                                   min="1"
                                   class="form-control width-100 quantity"
                                   placeholder="0"
                                   required>
                        </td>

                        <td>
                            <input type="number"
                                   name="unit_price[]"
                                   placeholder="0.00"
                                   value="0.00"
                                   min="1"
                                   step=".01"
                                   class="form-control width-100 unit_price"
                                   required>
                        </td>

                        <td>
                            <input type="number"
                                   name="selling_price[]"
                                   placeholder="0.00"
                                   value="0.00"
                                   min="1"
                                   step=".01"
                                   class="form-control width-100"
                                   required>
                        </td>

                        <td>
                            <input type="number"
                                   name="discount[]"
                                   placeholder="0.00"
                                   value="0.00"
                                   min="0"
                                   step=".01"
                                   class="form-control width-100 discount"
                                   required>
                        </td>

                        <td>
                            <input type="number"
                                   name="sub_total[]"
                                   placeholder="0.00"
                                   value="0.00"
                                   class="form-control width-100 sub_total"
                                   required readonly>
                        </td>


                        <td>
                            <button class="btn btn-sm btn-danger" disabled><i class="fa fa-trash"></i></button>
                        </td>

                    </tr>

                    </tbody>


                    <tfoot>

                    <tr>
                        <td colspan="5" class="text-end"><b>Grand Total = </b></td>
                        <td colspan="3">
                            <input type="number"
                                   name="grand_total"
                                   class="form-control grand_total"
                                   readonly>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-end"><b>Total Discount = </b></td>
                        <td colspan="3">
                            <input type="number"
                                   name="total_discount"
                                   value="0"
                                   min="0"
                                   step=".01"
                                   class="form-control total_discount">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-end"><b>Total Amount = </b></td>
                        <td colspan="3">
                            <input type="number"
                                   name="total_amount"
                                   class="form-control total_amount"
                                   readonly>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-end"><b>Total Pay = </b></td>
                        <td colspan="3">
                            <input type="number"
                                   name="total_pay"
                                   value="0"
                                   min="0"
                                   step=".01"
                                   class="form-control total_pay">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="text-end"><b>Total Due = </b></td>
                        <td colspan="3">
                            <input type="number"
                                   name="total_due"
                                   class="form-control total_due"
                                   readonly>
                        </td>
                    </tr>

                    </tfoot>

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

    <script type="text/javascript">

        // add purchase
        $(".add_product").click(function () {

            let html = '';

            html += '<tr id="inputFormRow">\
                        <th scope="row">1</th>\
                        <td>\
                            <select name="product_id[]" class="form-select" required>\
                                <option value="">Product</option>\
                                @foreach($products as $product)\
                                <option value="{{ $product->id }}">{{ $product->good->name }} - ({{ $product->model }})</option>\
                                @endforeach\
                            </select>\
                        </td>\
                        <td>\
                            <input type="number" id="invoice" name="quantity[]" value="1" min="1" class="form-control width-100 quantity" placeholder="0" required>\
                        </td>\
                        <td>\
                            <input type="number" name="unit_price[]" placeholder="0.00" value="0.00" min="1" step=".01" class="form-control width-100 unit_price" required>\
                        </td>\
                        <td>\
                            <input type="number" name="selling_price[]" placeholder="0.00" value="0.00" min="1" step=".01" class="form-control width-100 selling_price" required>\
                        </td>\
                        <td>\
                            <input type="number" name="discount[]" placeholder="0.00" value="0" min="0" step=".01" class="form-control width-100 discount" required>\
                        </td>\
                        <td>\
                            <input type="number" name="sub_total[]" step=".01" readonly placeholder="0.00" value="0" class="form-control width-100 sub_total" required>\
                        </td>\
                        <td>\
                            <button id="removeRow" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Product"><i class="fa fa-trash"></i></button>\
                        </td>\
                    </tr>';

            $('.purchase_table').find('tbody').append(html);

        });

        // remove purchase
        $(document).on('click', '#removeRow', function () {


            let sub_total = 0.00,
                total_amount = 0.00,
                total_discount = 0.00,
                grand_total = 0.00,
                update_grand_total = 0.00,
                update_total_amount = 0.00;

            sub_total = $(this).parent().parent().children().find('.sub_total').val();
            sub_total = sub_total ? parseFloat(sub_total) : parseFloat(0);

            grand_total = parseFloat($('.grand_total').val());
            total_discount = parseFloat($('.total_discount').val());

            update_grand_total = grand_total - sub_total;

            update_total_amount = update_grand_total - total_discount;

            $('.grand_total').val(update_grand_total);
            $('.total_amount').val(update_total_amount);
            $('.total_pay').val(0.00);
            $('.total_due').val(0.00);


            /*
             * Remove this row
             */

            $(this).closest('#inputFormRow').remove();


        });


        //purchage_table

        $('.purchase_table').on('keyup', '.quantity, .unit_price, .discount, .total_discount', function () {

            let quantity = 1,
                unit_price = 0.00,
                discount = 0.00,
                sub_total_per_tr = 0.00,
                sub_total = 0.00,
                total_amount = 0.00;

            quantity = $(this).parent().parent().children().find('.quantity').val();
            quantity = quantity ? parseFloat(quantity) : parseFloat(0);

            unit_price = $(this).parent().parent().children().find('.unit_price').val();
            unit_price = unit_price ? parseFloat(unit_price) : parseFloat(0);

            discount = $(this).parent().parent().children().find('.discount').val();
            discount = discount ? parseFloat(discount) : parseFloat(0);

            sub_total = (quantity * unit_price) - discount;


            // Sub total for indvidual row value set according to rules

            $(this).parent().parent().children().find('.sub_total').val(sub_total.toFixed(2));


            /*
             * Grand Total calculation
             */

            let grand_total = 0.00;

            $('.sub_total').each(function () {

                if ($(this).val()) {
                    grand_total += parseFloat($(this).val());
                }

            });

            $('.grand_total').val(grand_total.toFixed(2));


            /*
             * Total calculation
             */

            let total_discount = $('.total_discount').val();

            total_amount = parseFloat(grand_total.toFixed(2)) - total_discount;

            $('.total_amount').val(total_amount.toFixed(2));


        });

        $('.total_pay').on('keyup', function () {

            let total_amount = $('.total_amount').val(),
                total_pay = $(this).val(),
                total_due = 0.00;


            total_due = parseFloat(total_amount) - parseFloat(total_pay);

            $('.total_due').val(total_due.toFixed(2));

        });




    </script>

@endpush


