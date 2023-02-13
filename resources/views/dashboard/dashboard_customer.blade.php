@extends('layouts.master')

@section('content')

    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('dashboard') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex"></div>
            </div>

            <div class="card-body pb-5">
                    <div class="row mt-4">
                        <div class="col-md-3 my-profile"></div>

                        <div class="col-md-9 right-part" style="margin-top: -16px;">
                            <div class="edit-right-part-form">
                                <b>Dashboard Panel</b>
                                <hr>
                                UserType : <b>Customer</b>

                                <br>
                                Status :
                                @if(auth()->user()->isVerified())
                                    <b>Verified</b>
                                @elseif(auth()->user()->isUnVerified())
                                    <b>Not Verified</b>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('frontend.profile.scripts.update-profile-script')
@endpush
