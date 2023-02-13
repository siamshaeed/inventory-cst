@extends('layouts.master')

@section('content')
    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="#" class="link" data-bs-toggle="tooltip"
                           title="{{ __('Create ') }}">{{ __('Create Purchase') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex">
                    <a href="{{ route('purchase.index') }}" class="ms-1 text-orange" data-bs-toggle="tooltip"
                       title="View Product"><i class="fa fa-home"></i> Purchase</a>
                </div>
            </div>

            <div class="card-body pb-5 mb-3">
                @include('purchase.create_purchase_product')
            </div>

        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')



@endpush
