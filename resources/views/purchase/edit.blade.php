@extends('layouts.master')

@section('content')

    <div class="mt-3">

        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip"
                           title="{{ __('Create ') }}">{{ __('Update Purchase') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('purchase.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       title="View Product"><i class="fa fa-home"></i> Purchase</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">


                <form class="mt-4" action="{{ route('purchase.update', $purchase->id) }}" method="post">

                    @csrf

                    @method('put')

                    <div class="container">

                        <div class="row mb-3">

                            <div class="col-sm-3">
                                <b>Invoice Number</b> <span class="text-warning" title="Must be Required">*</span>
                                <input type="text"
                                       id="invoice"
                                       name="invoice"
                                       value="{{ old('invoice', $purchase->invoice_number) }}"
                                       class="form-control"
                                       placeholder="Enter invoice number ..." required>
                                <span class="text-warning">{{ $errors->first('invoice') }}</span>
                            </div>

                            <div class="col-sm-3">
                                <b>Purchase Date</b> <span class="text-warning" title="Must be Required">*</span>
                                <input type="date" id="date" name="date"
                                       value="{{ old('date', date('Y-m-d', strtotime($purchase->date))) }}"
                                       class="form-control" required>
                                <span class="text-warning">{{ $errors->first('date') }}</span>
                            </div>

                            <div class="col-sm-3">

                                <b> Supplier </b>

                                <span class="text-warning" title="Must be Required">*</span>

                                <select name="supplier_id" class="form-select" required>

                                    <option value="">Select Supplier</option>

                                    @foreach($suppliers as $supplier)

                                        <option
                                            value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }} - ({{ $supplier->market_type->name }})
                                        </option>

                                    @endforeach

                                </select>
                                <span class="text-warning">{{ $errors->first('supplier_id') }}</span>
                            </div>

                            <div class="col-sm-3">
                                <b>Purchase Status</b>
                                <span class="text-warning" title="Must be Required">*</span>
                                <select name="purchase_status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="1"
                                            class="text-warning" {{ $purchase->purchase_status == '1' ? 'selected' : '' }}>
                                        Ordered
                                    </option>
                                    <option value="2"
                                            class="text-danger" {{ $purchase->purchase_status == '2' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="3"
                                            class="text-success" {{ $purchase->purchase_status == '3' ? 'selected' : '' }}>
                                        Received
                                    </option>
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

                                    @if(count($purchase->items) > 0)

                                        @foreach($purchase->items as $key => $item)

                                            <tr class="product_row">

                                                <th scope="row">
                                                    {{ $key + 1 }}

                                                    <input type="hidden"
                                                           id="product_item_id"
                                                           name="product_item_id[]"
                                                           value="{{ $item->id }}"
                                                           class="form-control width-100 quantity"
                                                           placeholder="0"
                                                           required>
                                                </th>

                                                <td>
                                                    <select name="product_id[]"
                                                            class="form-select" required>

                                                        <option value="">Product</option>

                                                        @foreach($products as $product)

                                                            <option
                                                                value="{{ $product->id }}" {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                                {{ $product->good->name }} - ({{ $product->model }})
                                                            </option>

                                                        @endforeach

                                                    </select>

                                                </td>

                                                <td>
                                                    <input type="number"
                                                           id="invoice"
                                                           name="quantity[]"
                                                           value="{{ $item->quantity }}"
                                                           min="1"
                                                           class="form-control width-100 quantity"
                                                           placeholder="0"
                                                           required>
                                                </td>

                                                <td>
                                                    <input type="number"
                                                           name="unit_price[]"
                                                           placeholder="0.00"
                                                           value="{{ $item->unit_price }}"
                                                           min="1"
                                                           step=".01"
                                                           class="form-control width-100 unit_price"
                                                           required>
                                                </td>

                                                <td>
                                                    <input type="number"
                                                           name="selling_price[]"
                                                           placeholder="0.00"
                                                           value="{{ $item->selling_price }}"
                                                           min="1"
                                                           step=".01"
                                                           class="form-control width-100"
                                                           required>
                                                </td>

                                                <td>
                                                    <input type="number"
                                                           name="discount[]"
                                                           placeholder="0.00"
                                                           value="{{ $item->discount }}"
                                                           min="0"
                                                           step=".01"
                                                           class="form-control width-100 discount"
                                                           required>
                                                </td>

                                                <td>
                                                    <input type="number"
                                                           name="sub_total[]"
                                                           placeholder="0.00"
                                                           value="{{ $item->sub_total }}"
                                                           class="form-control width-100 sub_total"
                                                           required readonly>
                                                </td>


                                                <td>

                                                    <button class="btn btn-sm btn-danger remove_item"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Remove Product">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </td>

                                            </tr>

                                        @endforeach



                                    @else

                                        <tr class="product_row">

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
                                                <button class="btn btn-sm btn-danger remove_item"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Remove Product">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </td>

                                        </tr>

                                    @endif


                                    </tbody>


                                    <tfoot>

                                    <tr>
                                        <td colspan="5" class="text-end"><b>Grand Total = </b></td>
                                        <td colspan="3">
                                            <input type="number"
                                                   name="grand_total"
                                                   value="{{ old('grand_total', $purchase->grand_amount) }}"
                                                   class="form-control grand_total"
                                                   readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-end"><b>Total Discount = </b></td>
                                        <td colspan="3">
                                            <input type="number"
                                                   name="total_discount"
                                                   value="{{ old('total_discount', $purchase->total_discount) }}"
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
                                                   value="{{ old('total_amount', $purchase->total_amount) }}"
                                                   class="form-control total_amount"
                                                   readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-end"><b>Total Pay = </b></td>
                                        <td colspan="3">
                                            <input type="number"
                                                   name="total_pay"
                                                   value="{{ old('total_pay', $purchase->total_pay) }}"
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
                                                   value="{{ old('total_due', $purchase->total_due) }}"
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
                            <div class="col-sm-2">
                                <button class="btn btn-secondary col-sm-12">Update Purchase</button>
                            </div>
                        </div>
                    </div>

                </form>


            </div>

        </div>

    </div>

@endsection

@push('styles')
@endpush

@push('scripts')

    <script type="text/javascript">

        // add purchase
        $(".add_product").click(function () {

            let html = '';

            html += '<tr class="product_row">\
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
                            <button class="btn btn-sm btn-danger remove_item" data-toggle="tooltip" data-placement="top" title="Remove Product"><i class="fa fa-trash"></i></button>\
                        </td>\
                    </tr>';

            $('.purchase_table').find('tbody').append(html);

        });

        // remove purchase
        $(document).on('click', '.remove_item', function () {


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

            $(this).closest('.product_row').remove();


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

            console.log(total_discount + ' ' + grand_total);

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

