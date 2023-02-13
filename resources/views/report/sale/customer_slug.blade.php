@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.sale.customerSlug', $supplier->slug) }}" class="link" data-bs-toggle="tooltip" title="{{ __('Sale Customer View') }}">
                            {{ __('Sale Customer Report') }}
                        </a>
                        : <b>{{$supplier->name}}</b>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($sales))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.sale.customerSlug', $supplier->slug) }}" method="get">
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

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.sale.customerSlug', $supplier->slug) }}" method="get">
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

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.sale.customerSlug', $supplier->slug) }}" method="get">
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
                            <th scope="col">{{ __("Date") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Product Quantity">{{ __("Qty") }}</th>

                            <th scope="col">{{ __("Total Price") }}</th>
                            <th scope="col">{{ __("Total Discount") }}</th>
                            <th scope="col">{{ __("Total Pre Due") }}</th>

                            <th scope="col">{{ __("Grand Amount") }}</th>
                            <th scope="col">{{ __("Pay") }}</th>
                            <th scope="col">{{ __("Due") }}</th>

                            <th scope="col">{{ __("Status") }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $total_qty = 0; @endphp
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->date }}</td>
                                <td>
                                    {{ $sale->sale_items->count() }}
                                    @php $total_qty += $sale->sale_items->count() @endphp
                                </td>

                                <td>
                                    <b>{{ $sale->grand_amount }}</b>
                                </td>
                                <td>{{ $sale->total_discount }}</td>
                                <td>{{ $sale->total_pre_due }}</td>

                                <td style="border-right: 1px solid black;">
                                    <b>{{ $sale->total_amount }}</b>
                                </td>
                                <td>{{ $sale->total_pay }}</td>
                                <td>{{ $sale->total_due }}</td>

                                <td>
                                    @include('sale.common_field_payment_status')
                                </td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>
                        <tfooter>
                            @if(!empty($sales))
                                <tr>
                                    <td colspan="2"><b>Summary</b></td>
                                    <td>
                                        <b>{{ $total_qty }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $sales->sum('grand_amount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $sales->sum('total_discount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $sales->sum('total_pre_due') }}</b>
                                    </td>
                                    <td style="border-right: 1px solid black;">
                                        <b>{{ $sales->sum('total_amount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $sales->sum('total_pay') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $sales->sum('total_due') }}</b>
                                    </td>

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

