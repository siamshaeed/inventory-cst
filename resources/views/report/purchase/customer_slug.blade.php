@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.purchase.customerSlug', $supplier->slug) }}" class="link" data-bs-toggle="tooltip" title="{{ __('Purchase Items View') }}">{{ __('Purchase Customer Report') }}</a>
                        : <b class="text-primary">{{ $supplier->name }}</b> - {{ $supplier->market_type->name }}

                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($purchases))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.purchase.customerSlug', $supplier->slug) }}" method="get">
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

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.purchase.customerSlug', $supplier->slug) }}" method="get">
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

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.purchase.customerSlug', $supplier->slug) }}" method="get">
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
                            <th scope="col" data-tottle="tooltip" title="Invoice Number">{{ __("Invoice") }}</th>
                            <th scope="col" data-toggle="tooltip">{{ __("Purchase Status") }}</th>
                            <th scope="col" >{{ __("Grand Amount") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Total Discount">{{ __("Discount") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Total Amount">{{ __("Total") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Paid Amount">{{ __("Paid") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Due Amount">{{ __("Due") }}</th>
                            <th scope="col">{{ __("Payment Status") }}</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($purchases as $purchase)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchase->date}}</td>
                                <td>{{ $purchase->invoice_number }}</td>
                                <td>
                                    @if($purchase->isOrdered())
                                        <span class="badge bg-warning">Ordered</span>
                                    @elseif($purchase->isPending())
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($purchase->isReceived())
                                        <span class="badge bg-success">Received</span>
                                    @endif
                                </td>
                                <td><b>{{ $purchase->grand_amount }}</b></td>
                                <td>
                                    {{ $purchase->total_discount }}
                                </td>
                                <td style="border-right-color: black;"><b>{{ $purchase->total_amount }}</b></td>
                                <td><b>{{ $purchase->total_pay }}</b></td>
                                <td>{{ $purchase->total_due }}</td>
                                <td>
                                    @if($purchase->isUnpaid())
                                        <span class="badge bg-warning">unPaid</span>
                                    @elseif($purchase->isPartiallyPaid())
                                        <span class="badge bg-danger">Partially Paid</span>
                                    @elseif($purchase->isPaid())
                                        <span class="badge bg-success">Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>

                        <tfooter>
                            @if(!empty($purchases))
                                <tr>
                                    <th scope="col" colspan="4">
                                        {{ __("Total ") }}
                                    </th>
                                    <td>
                                        <b>{{ $purchases->sum('grand_amount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $purchases->sum('total_discount') }}</b>
                                    </td>
                                    <td style="border-right-color: black;">
                                        <b>{{ $purchases->sum('total_amount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $purchases->sum('total_pay') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ $purchases->sum('total_due') }}</b>
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

