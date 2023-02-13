
<form class="mt-4" action="{{ route('purchase.store') }}" method="post" id="addFormData">
    @csrf


    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-3">
                <b>Invoice Number</b>
                <input type="text" value="{{ $purchase->invoice_number }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Purchase Date</b>
                <input type="text" value="{{ $purchase->date }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Supplier</b>
                <input type="text" value="{{ $purchase->supplier->name }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Purchase Status</b>
                <span class="form-control" readonly>
                    @if($purchase->isOrdered())
                        <span class="text-warning">Ordered</span>
                    @elseif($purchase->isPending())
                        <span class="text-danger">Pending</span>
                    @elseif($purchase->isReceived())
                        <span class="text-success">Received</span>
                    @endif
                </span>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row mb-3">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">
                        Total Price
                        {{--or Line Price--}}
                    </th>
                    <th scope="col">Selling Price</th>
                </tr>
                </thead>

                <tbody>
                @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td><b class="text-success">{{ $item->product->good->name }}</b> - {{ $item->product->brand->name }}</td>
                        <td><b>{{ $item->quantity }}</b></td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->discount }}</td>
                        <td><b>{{ $item->sub_total }}</b></td>
                        <td>{{ $item->selling_price }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>

                <tfooter>
                    <tr>
                        <td colspan="5" class="text-end"><b>Sub Total = </b></td>
                        <td colspan="2">{{ $purchase->grand_amount }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Discount = </b></td>
                        <td colspan="2">{{ $purchase->total_discount }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Total Amount = </b></td>
                        <td colspan="2"><b>{{ $purchase->total_amount }}</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Pay = </b></td>
                        <td colspan="2">{{ $purchase->total_pay }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Due = </b></td>
                        <td colspan="2">
                            @if($purchase->total_due > 0)
                                <b class="text-warning">{{ $purchase->total_due }}</b>
                            @else
                                <b>{{ $purchase->total_due }}</b>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                </tfooter>

            </table>

        </div>
    </div>



    <div class="container">
        <div class="row mb-3">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Pay</th>
                    <th scope="col">Due</th>
                </tr>
                </thead>

                <tbody>
                @foreach($purchase_dues as $purchase_due)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td><b>{{ $purchase_due->date }}</b></td>
                        <td>{{ $purchase_due->pay }}</td>
                        <td>{{ $purchase_due->due }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>

                <tfooter>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>{{ $total_pay }}</b></td>
                        <td>
                            {{--last due status row of data--}}
                            @if($purchase_due->due > 0)
                                <b class="text-warning">{{ $purchase_due->due }}</b>
                            @else
                                <b>{{ $purchase_due->due }}</b>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                </tfooter>

            </table>

        </div>
    </div>


</form>

@push('styles')
@endpush

@push('scripts')
@endpush
