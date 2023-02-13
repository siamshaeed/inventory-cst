@extends('layouts.master')

@section('content')

    <div class="mt-3 mb-4">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('home') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex"></div>
            </div>
            <div class="card-body pb-5">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <dl class="row">
                    <dt class="col-sm-3 text-end">Name :</dt>
                    <dd class="col-sm-9">{{ auth()->user()->name }} </dd>

                    <dt class="col-sm-3 text-end">Contact :</dt>
                    <dd class="col-sm-9">{{ auth()->user()->phone_number }} </dd>

                    <dt class="col-sm-3 text-end">User Type :</dt>
                    <dd class="col-sm-9">
                        @if(auth()->user()->hasRole('admin'))
                            <b>Admin</b>
                        @elseif(auth()->user()->hasRole('workshop'))
                            <b>Workshop</b>
                        @elseif(auth()->user()->hasRole('customer'))
                            <b>Customer</b>
                        @endif
                    </dd>
                </dl>

            </div>
        </div>
    </div>
@endsection
