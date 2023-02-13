@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.purchase.customer') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Order Items View') }}">{{ __('Order Customer Report') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($orders))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.order.customer') }}" method="get">
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

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.order.customer') }}" method="get">
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

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.order.customer') }}" method="get">
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
                            <th scope="col">{{ __("Created") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Order Number">{{ __("Order Number") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Order Name">{{ __("Order Name") }}</th>
                            <th scope="col" >{{ __("Grand Total") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Total Discount">{{ __("Discount") }}</th>
                            <th scope="col" data-tottle="tooltip" title="Total Amount">{{ __("Total") }}</th>
                            <th scope="col" data-toggle="tooltip">{{ __("Order Status") }}</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->date }}</td>
                                <td><b>{{ $order->order_number }}</b></td>
                                <td>{{ $order->supplier->name }}</td>
                                <td>{{ $order->	grand_total }}</td>
                                <td>{{ $order->total_discount }}</td>
                                <td>{{ $order->total_amount}}</td>
                                <td>
                                    @if($order->isRequest())
                                        <span class="badge bg-warning">Request</span>
                                    @elseif($order->isPending())
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($order->isCompleted())
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>

                        <tfooter>
                            <tr>
                                <th scope="col" colspan="4" style="text-align: left" data-toggle="tooltip">{{ __("Total ") }}</th>

                                <td>@if(!empty($order))
                                        <b>{{ $order->sum('grand_total') }}</b>
                                    @endif</td>

                                <td>@if(!empty($order))
                                        <b>{{ $order->sum('total_discount') }}</b>
                                    @endif</td>

                                <td>@if(!empty($order))
                                        <b>{{ $order->sum('total_amount') }}</b>
                                    @endif</td>

                                <td></td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

