@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('report.expense') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Purchase Items View') }}">{{ __('Expense Report') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    {{--<a href="#" class="ms-1 btn btn-sm btn-warning text-white" data-bs-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i> Print
                    </a>--}}

                    @if(!empty($expenses))
                        <form class="col-md-3- mt-4- mb-4-" action="{{ route('report.expense') }}" method="get">
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

                        <form class="mt-4 mb-4 col-md-9" action="{{ route('report.expense') }}" method="get">
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="col-sm-12">
                                       <div class="input-group date" id="datepicker">
                                           <input type="text" name="start_date" value="{{ $start_date }}" class="form-control" placeholder="From Date" required>
                                           <span class="input-group-append"></span>
                                        </div>
                                   </div>
                               </div>

                               <div class="col-md-4">
                                   <div class="col-sm-12">
                                       <div class="input-group date" id="datepicker2">
                                           <input type="text" name="end_date" value="{{ $end_date }}" class="form-control" placeholder="To Date" required>
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

                        <form class="col-md-3 mt-4 mb-4" action="{{ route('report.expense') }}" method="get">
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
                            <th scope="col" data-toggle="tooltip">{{ __("Expense Category") }}</th>
                            <th scope="col" data-toggle="tooltip" title="Title or Note">{{ __("Title") }}</th>
                            <th scope="col" data-toggle="tooltip" class="text-end">{{ __("Amount") }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->category->name }}</td>
                                <td>{{ $expense->title }}</td>
                                <td class="text-end"><b>{{ $expense->amount }}</b></td>
                            </tr>
                        @empty
                            <b class="text-warning">No Data Found !</b>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="col" colspan="4" style="text-align: left" data-toggle="tooltip">{{ __("Total") }}</th>
{{--                            <th scope="col"  data-toggle="tooltip" >{{ $expenses->sum('amount') }}</th>--}}
                            <th scope="col"  data-toggle="tooltip" class="text-end">
                            @if(!empty($expenses))
                                {{ number_format($expenses->sum('amount'), 2) }}
                                @endif
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

