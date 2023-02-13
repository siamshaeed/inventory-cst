@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip" title="{{ __('Invoice Details View ') }}">{{ __('Sale Invoice Details') }}</a>
                        {{--Invoice: {{ $purchase->invoice_number }}--}}
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('sale.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       title="View Sale"><i class="fa fa-home"></i> Sale</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">
                @include('sale.show_sale_invoice_details')
            </div>

        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
