@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip"
                           title="{{ __('Create ') }}">{{ __('Order Product Sale') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('order.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       data-popper-placement="top"
                       title="Back to Order"><i class="fa fa-home"></i> Order</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">
                @include('sale.create_order_sale')
            </div>

        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
