
<form class="mt-4" action="{{ route('order.store') }}" method="post" id="addFormData">
    @csrf


    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-3">
                <b>Order Number</b>
                <input type="text" value="{{ $order->order_number }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Order Date</b>
                <input type="text" value="{{ $order->date }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Order Name</b>
                <input type="text" value="{{ $order->supplier->name }}" class="form-control" readonly>
            </div>
            <div class="col-sm-3">
                <b>Order Status</b>
                <span class="form-control" readonly>
                    @if($order->isRequest())
                        <span class="text-warning">Ordered</span>
                    @elseif($order->isPending())
                        <span class="text-danger">Pending</span>
                    @elseif($order->isCompleted())
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
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Sub Total</th>
                </tr>
                </thead>

                <tbody>
                @foreach($order_items as $order_item)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td><b class="text-success">{{ $order_item->product->good->name }}</b> - {{ $order_item->product->brand->name }}</td>
                        <td><b>{{ $order_item->quantity }}</b></td>
                        <td>{{ $order_item->unit_price }}</td>
                        <td>{{ $order_item->discount }}</td>
                        <td><b>{{ $order_item->sub_total }}</b></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>

                <tfooter>
                    <tr>
                        <td colspan="5" class="text-end"><b>Order Total Amount = </b></td>
                        <td colspan="2"><b>{{ $order->total_amount }}</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Total Discount = </b></td>
                        <td colspan="2"><b>{{ $order->total_discount }}</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><b>Order Status = </b></td>
                        <td colspan="2">
                            @if($order->isRequest())
                                <span class="text-warning"><b>Ordered</b></span>
                            @elseif($order->isPending())
                                <span class="text-danger"><b>Pending</b></span>
                            @elseif($order->isCompleted())
                                <span class="text-success"><b>Received</b></span>
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

            {{--<table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>

                <tbody>
                --}}{{--@foreach($order_dues as $order_due)--}}{{--
                    <tr>
                        <th scope="row">-</th>
                        <td><b>---</b></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                --}}{{--@endforeach--}}{{--
                </tbody>

                <tfooter>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>{{ $total_pay }}</b></td>
                        <td>
                            --}}{{--last due status row of data--}}{{--
                            @if($order_due->due > 0)
                                <b class="text-warning">{{ $order_due->due }}</b>
                            @else
                                <b>{{ $order_due->due }}</b>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                </tfooter>

            </table>--}}

        </div>
    </div>


</form>

@push('styles')
@endpush

@push('scripts')
@endpush
