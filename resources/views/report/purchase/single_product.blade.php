@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.purchase.singleProduct') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Purchase Single Product View') }}">{{ __('Purchase Single Product Report') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($purchase_items))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.purchase.singleProduct') }}" method="get">
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

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.purchase.singleProduct') }}" method="get">
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

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.purchase.singleProduct') }}" method="get">
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
                            <th scope="col">{{ __("Buying Date") }}</th>
                            <th scope="col">{{ __("Product Name") }}</th>

                            <th scope="col">{{ __("Quantity") }}</th>
                            <th scope="col">{{ __("Price") }}</th>
                            <th scope="col">{{ __("Discount") }}</th>
                            <th scope="col">{{ __("Total") }}</th>

                            <th scope="col">{{ __("Selling Price") }}</th>
                            <th scope="col">{{ __("Qty Out") }}</th>
                            <th scope="col">{{ __("Qty Available") }}</th>
                            <th scope="col">{{ __("Stock Status") }}</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($purchase_items as $items)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $items->purchase->date }}
                                </td>
                                <td>
                                    <b>{{ $items->product->good->name}}</b>
                                </td>

                                <td>{{ $items->quantity }}</td>
                                <td>{{ $items->unit_price }}</td>
                                <td>{{ $items->discount }}</td>
                                <td style="border-right-color: black;">
                                    {{ $items->sub_total }}
                                </td>

                                <td style="border-right-color: black;">
                                    {{ $items->selling_price }}
                                </td>
                                <td>{{ $items->stock_out }}</td>
                                <td>{{ $items->stock_available }}</td>
                                <td>
                                    @if($items->isStockAvailable())
                                        <span class="badge bg-success">Available</span>
                                    @elseif($items->isStockOut())
                                        <span class="badge bg-danger">Stock Out</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>

                        <tfooter>
                            @if(!empty($purchase_items))
                            <tr>
                                <th scope="col" colspan="6">
                                    {{ __("Total ") }}
                                </th>

                                <td style="border-right-color: black;">
                                    <b>{{ $purchase_items->sum('sub_total') }}</b>
                                </td>
                                <td style="border-right-color: black;">
                                    <b>{{ $purchase_items->sum('selling_price') }}</b>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                        </tfooter>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection

