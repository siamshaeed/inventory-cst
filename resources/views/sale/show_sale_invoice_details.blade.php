
<form class="mt-4" action="#" method="post" id="addFormData">
    @csrf

    <div class="container">
        <div class="row mb-3"><b class="link">Order Information</b>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Order Date</th>
                    <th scope="col">Order Number</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Supplier Type</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Order Creator</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->supplier->name }}</td>
                    <td>{{ $order->supplier->market_type->name }}</td>
                    <td>
                        @include('order.common_field_order_status')
                    </td>
                    <td>{{ $order->user->name }}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

    <div class="container">
        <div class="row mb-3"><b class="link">Order Items</b>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Order Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($order_items as $order_item)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $order_item->date }}</td>
                        <td>{{ $order_item->product->good->name }} - [{{ $order_item->product->brand->name }}]</td>
                        <td>{{ $order_item->quantity }}</td>
                        <td>{{ $order_item->unit_price }}</td>
                        <td>{{ $order_item->discount }}</td>
                        <td>{{ $order_item->sub_total }}</td>
                        <td>
                            @include('order_item.common_field_item_status')
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <tfooter>
                    <tr>
                        <td colspan="5"></td>
                        <td class="text-end"><b>Total Price = </b></td>
                        <td><b>{{ $order->grand_total }}</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td class="text-end"><b>Total Discount = </b></td>
                        <td>{{ $order->total_discount }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td class="text-end"><b>Grand Total = </b></td>
                        <td><b>{{ $order->total_amount }}</b></td>
                        <td></td>
                    </tr>
                </tfooter>
            </table>

        </div>
    </div>

    <div class="container">
        <div class="row mb-3"><b class="link">Sale Items</b>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Sub Total</th>
                    {{--<th scope="col">Order Status</th>--}}
                </tr>
                </thead>

                <tbody>
                @foreach($sale_items as $sale_item)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $sale_item->date }}</td>
                        <td>{{ $order_item->product->good->name }} - [{{ $order_item->product->brand->name }}]</td>
                        <td>{{ $sale_item->qty }}</td>
                        <td>{{ $sale_item->unit_price }}</td>
                        <td>{{ $sale_item->total_price }}</td>
                        <td>{{ $sale_item->discount }}</td>
                        <td><b>{{ $sale_item->sub_total }}</b></td>
                        {{--<td>
                            @include('order_item.common_field_item_status')
                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Total Price = </b></td>
                        <td><b>{{ $sale->grand_amount }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Discount = </b></td>
                        <td>{{ $sale->total_discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Pre Due = </b></td>
                        <td>{{ $sale->pre_due }}</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Grand Amount = </b></td>
                        <td><b>{{ $sale->total_amount }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Total Pay = </b></td>
                        <td>{{ $sale->total_pay }}</td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Total Due = </b></td>
                        <td><b>{{ $sale->total_due }}</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td class="text-end"><b>Payment Status = </b></td>
                        <td>
                            @include('sale.common_field_payment_status')
                        </td>
                    </tr>
                </tfooter>
            </table>

        </div>
    </div>

    <div class="container">
        <div class="row mb-3"><b class="link">Sale Payment History</b>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Pay</th>
                    <th scope="col">Due</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($sale_payments as $sale_payment)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $sale_payment->date }}</td>
                        <td>{{ $sale_payment->amount }}</td>
                        <td><b>{{ $sale_payment->pay }}</b></td>
                        <td><b>{{ $sale_payment->due }}</b></td>
                        <td>
                            @include('sale_payment.___common_field_payment_status')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</form>

@push('styles')
@endpush

@push('scripts')
@endpush
