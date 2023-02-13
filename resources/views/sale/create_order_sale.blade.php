<form class="mt-4-" action="{{ route('sale-order-store', $order->id) }}" method="post" id="addFormData">
    @csrf
    {{ method_field('PUT') }}


    <div class="container">
        <div class="row mb-3">

            <div class="table-responsive">
                <b class="link"><h5>Stock Available</h5></b>
                <table class="table table-warning table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Stock In</th>
                        <th scope="col">Stock Out</th>
                        <th scope="col">Available</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>

                    <tbody>

                    @if(count($purchase_items) > 0)

                        @foreach($purchase_items as $purchase_item)

                            <tr>

                                <th scope="row">{{ $loop->index+1 }}</th>

                                <td>{{ $purchase_item->purchase->date }}</td>

                                <td>
                                    <b>{{ $purchase_item->product->good->name }}</b>
                                    <br> {{ $purchase_item->product->brand->name }}<span></span>
                                </td>

                                <td>
                                    <b class="text-success">{{ $purchase_item->quantity }}</b>
                                </td>

                                <td>
                                    {{ $purchase_item->stock_out }}
                                </td>

                                <td>
                                    <b class="text-success">{{ $purchase_item->stock_available }}</b>
                                </td>

                                <td>
                                    @include('purchase_item.common_field_stock_status')
                                </td>

                            </tr>

                        @endforeach

                    @endif

                    </tbody>

                    <tfooter>

                        <tr></tr>

                    </tfooter>

                </table>
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row mb-3">

            <div class="table-responsive">
                <div class="mb-3 row">
                    <div class="col-sm-2">
                        <b class="link"><h5>Order Items</h5></b>
                    </div>
                    <label for="date" class="col-sm-2 col-form-label text-end"><b>Date</b> <span class="text-warning" title="Must be Required">*</span></label>
                    <div class="col-sm-4">
                        <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control" required>
                        <span class="text-warning">{{ $errors->first('date') }}</span>
                    </div>
                </div>
                <table class="table table-striped order_items">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($order_items as $order_item)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>
                                <b>{{ $order_item->product->good->name }}</b>
                                <br> {{ $order_item->product->brand->name }}
                                <input type="hidden" name="product_id[]" value="{{ $order_item->product->id }}">
                                <input type="hidden" name="order_item_id[]" value="{{ $order_item->id }}">
                            </td>

                            <td class="w-25">
                                <button type="button" class="btn btn-sm btn-secondary">
                                    {{ $order_item->quantity }}
                                </button>

                                <input type="number"
                                       id="invoice"
                                       name="quantity[]"
                                       value="1"
                                       min="1"
                                       max="{{ $order_item->product->stock }}"
                                       class="width-100 quantity"
                                       required>
                                <br>

                                @if($order_item->product->stock == 0)
                                    <span class="badge bg-danger"
                                          data-toggle="tooltip"
                                          title="Stock Not Available">&nbsp; Stock : {{ $order_item->product->stock }} &nbsp;
                                    </span>
                                @else
                                    <span
                                        class="badge bg-dark">&nbsp; Stock: {{ $order_item->product->stock }} &nbsp;
                                    </span>
                                @endif
                            </td>

                            <td>
                                <input type="number"
                                       name="unit_price[]"
                                       value="{{ $order_item->unit_price }}"
                                       min="1"
                                       step="any"
                                       class="width-100 unit_price"
                                       required>
                            </td>
                            <td>
                                <input type="number"
                                       name="total_price[]"
                                       value="{{ $order_item->total_price }}"
                                       min="1"
                                       step="any"
                                       class="width-100 total_price"
                                       required>
                            </td>
                            <td>
                                <input type="number"
                                       name="discount[]"
                                       value="{{ $order_item->discount }}"
                                       min="0"
                                       step="any"
                                       class="width-100 discount"
                                       required>
                            </td>
                            <td>
                                <input type="number"
                                       name="sub_total[]"
                                       value="{{ $order_item->sub_total }}"
                                       class="width-100 sub_total"
                                       readonly
                                       required>
                            </td>

                            <td>
                                @include('order_item.common_field_item_status')
                            </td>

                            <td>
                                <button class="btn btn-sm btn-danger remove_row"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                    <tfooter>

                        <tr>
                            <td colspan="5" class="text-end"><b>Total Amount = </b></td>
                            <td colspan="3">
                                <input type="number"
                                       name="grand_amount"
                                       value="{{ $order_items->sum('sub_total') }}"
                                       class="form-control total_amount"
                                       required>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-end"><b>Total Discount = </b></td>
                            <td colspan="3">
                                <input type="number"
                                       name="total_discount"
                                       value="0"
                                       min="0"
                                       step="any"
                                       class="form-control total_discount">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-end"><b>Total Previous Due = </b></td>
                            <td colspan="3">
                                <input type="number"
                                       name="total_pre_due"
                                       value="{{ $order->total_pre_due }}"
                                       min="0"
                                       step="any"
                                       class="form-control total_discount">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-end"><b>Grand Total = </b></td>
                            <td colspan="3">
                                <input type="number"
                                       name="total_amount"
                                       class="form-control grand_total"
                                       value="0"
                                       min="0"
                                       required>
                            </td>
                        </tr>

                        <tr>

                            <td colspan="5" class="text-end">
                                <b>Total Pay = </b>
                            </td>

                            <td colspan="3">
                                <input type="number"
                                       name="total_pay"
                                       value="0"
                                       min="0"
                                       step="any"
                                       class="form-control total_pay">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-end"><b>Due = </b></td>
                            <td colspan="3">
                                <input type="number"
                                       name="total_due"
                                       value="0"
                                       min="0"
                                       class="form-control total_due" required>
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

    <script type="text/javascript">

        $('.order_items').on('keyup', '.quantity, .unit_price, .discount, .total_discount', function () {

            let quantity = 1,
                unit_price = 0.00,
                total_price = 0.00,
                discount = 0.00,
                sub_total = 0.00,
                total_amount = 0.00,
                grand_total = 0.00,
                total_pay = 0.00,
                total_due = 0.00;

            quantity = $(this).parent().parent().children().find('.quantity').val();
            quantity = quantity ? parseFloat(quantity) : parseFloat(0);

            unit_price = $(this).parent().parent().children().find('.unit_price').val();
            unit_price = unit_price ? parseFloat(unit_price) : parseFloat(0);

            total_price = quantity * unit_price;
            $(this).parent().parent().children().find('.total_price').val(total_price.toFixed(2));


            discount = $(this).parent().parent().children().find('.discount').val();
            discount = discount ? parseFloat(discount) : parseFloat(0);

            sub_total = (quantity * unit_price) - discount;


            // Subtotal for individual row value set according to rules

            $(this).parent().parent().children().find('.sub_total').val(sub_total.toFixed(2));


            /*
             * Grand Total calculation
             */

            $('.sub_total').each(function () {

                if ($(this).val()) {
                    total_amount += parseFloat($(this).val());
                }

            });

            $('.total_amount').val(total_amount.toFixed(2));


            /*
             * Total calculation
             */

            let total_discount = $('.total_discount').val();

            grand_total = parseFloat(total_amount.toFixed(2)) - total_discount;

            $('.grand_total').val(grand_total.toFixed(2));

            $('.total_pay').val(0.00);

            $('.total_due').val(grand_total);

        });


        $('.total_pay').on('keyup', function () {

            let grand_total = $('.grand_total').val(),
                total_pay = $(this).val(),
                total_due = 0.00;


            total_due = parseFloat(grand_total) - parseFloat(total_pay);

            $('.total_due').val(total_due.toFixed(2));

        });


        $('.remove_row').on('click', function () {

            let sub_total = 0.00,
                total_amount = 0.00,
                total_discount = 0.00,
                grand_total = 0.00,
                update_total_amount = 0.00;

            sub_total = $(this).parent().parent().children().find('.sub_total').val();
            sub_total = sub_total ? parseFloat(sub_total) : parseFloat(0);

            total_amount = parseFloat($('.total_amount').val());
            total_discount = parseFloat($('.total_discount').val());

            update_total_amount = total_amount - sub_total;

            grand_total = update_total_amount - total_discount;

            $('.total_amount').val(update_total_amount);
            $('.grand_total').val(grand_total);
            $('.total_pay').val(0.00);
            $('.total_due').val(0.00);


            /*
             * Remove this row
             */

            $(this).closest('tr').remove();

        });


    </script>

@endpush
