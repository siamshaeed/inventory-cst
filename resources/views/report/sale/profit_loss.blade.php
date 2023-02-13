@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.sale.profitLoss') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Sale Items View') }}">{{ __('Sale Report') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($sale_item_lists))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.sale.profitLoss') }}" method="get">
                            @include('report.common_pdf_download_button')
                        </form>
                    @endif

                    {{--<a href="#" class="ms-1 btn btn-sm btn-success text-white" data-bs-toggle="tooltip" title="Excel Download">
                        <i class="fa fa-file-excel"></i> Excel
                    </a>--}}
                </div>
            </div>

            <div class="card-body pb-5">

                <div class="col-md-12">
                    <div class="row">

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.sale.profitLoss') }}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-sm-12">
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" name="start_date" value="{{ $start_date }}" class="form-control" placeholder="From Date">
                                            <span class="input-group-append"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-sm-12">
                                        <div class="input-group date" id="datepicker2">
                                            <input type="text" name="end_date" value="{{ $end_date }}" class="form-control" placeholder="To Date">
                                            <span class="input-group-append"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-sm-12">
                                        <button class="btn btn-secondary btn-submit w-100">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.sale.profitLoss') }}" method="get">
                            <div class="">
                                <div class="col-sm-12">
                                    <input type="hidden" name="date" value="all-data">
                                    <button class="btn btn-secondary btn-success w-100">All Time</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="table-responsive">
                    <table id="custom-table" class="table pt-3">
                        <thead>
                        <tr>
                            <th scope="col">{{ __("SL") }}</th>
                            <th scope="col" style="width: 100px;">{{ __("Date") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Product Name">{{ __("Product Name") }}</th>

                            <th scope="col" data-toggle="tooltip">{{ __("Quantity") }}</th>
                            <th scope="col">{{ __("UnitPrice") }}</th>
                            <th scope="col">{{ __("SubTotal") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Discount & Average Discount">{{ __("Discount") }}</th>
                            <th scope="col">{{ __("GrandTotal") }}</th>

                            <th scope="col">{{ __("BuyPrice") }}</th>
                            <th scope="col">{{ __("SalePrice") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Profit or Loss">{{ __("Profit or Loss") }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $total_buy_count = 0; $total_sale_count = 0; @endphp
                        @forelse($sale_item_lists as $list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $list->sale_item->date }}</td>
                                <td>
                                    <b>{{ $list->sale_item->product->good->name }}</b> <br> {{ $list->sale_item->product->brand->name }}
                                </td>

                                <td>{{ $list->qty }}</td>
                                <td>{{ $list->sale_item->unit_price }}</td>
                                <td>
                                    @php
                                        $sub_total = $list->qty * $list->sale_item->unit_price;
                                    @endphp
                                    <b>{{ $sub_total }}</b>
                                </td>
                                <td>
                                    @php
                                        $discount           = number_format($list->sale_item->discount / $list->sale_item->qty, 2) * $list->qty;
                                        $average_discount   = number_format($list->sale_item->average_discount / $list->sale_item->qty, 2) * $list->qty;
                                        $total_discount     = $discount + $average_discount;
                                    @endphp
                                    {{--{{ $discount }} + {{ $average_discount }} <br> =--}}
                                    {{ $total_discount }}
                                </td>
                                <td style="border-right: 1px solid black;">
                                    @php
                                        $grand_total = $sub_total - $total_discount;
                                        $total_sale_count += $grand_total;
                                    @endphp
                                    <b>{{ $grand_total }}</b>
                                </td>

                                <td>
                                    @php
                                        $buy_unit_price = $list->purchase_item->unit_price;
                                        $total_buy_price = $buy_unit_price * $list->qty;
                                        $total_buy_count += $total_buy_price;
                                    @endphp
                                    {{ $total_buy_price }}
                                </td>
                                <td>{{ $grand_total }}</td>
                                <td>
                                    @php
                                        $loss_and_profit = $grand_total - $total_buy_price;
                                    @endphp

                                    @if($loss_and_profit < 0)
                                        <b class="text-warning">{{ $loss_and_profit }}</b>
                                    @else
                                        <b class="text-success">{{ $loss_and_profit }}</b>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>
                        <tfooter>
                            <tr>
                                <td colspan="7"><b>Summary</b></td>
                                <td style="border-right: 1px solid black;"><b>{{ $total_sale_count }}</b></td>
                                <td><b>{{ $total_buy_count }}</b></td>
                                <td><b>{{ $total_sale_count }}</b></td>
                                <td><b>{{ $total_sale_count - $total_buy_count }}</b></td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

