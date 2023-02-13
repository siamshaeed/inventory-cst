@extends('layouts.master')

@section('content')

    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('profile.info') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Profile Information') }}">{{ __('Profile Info') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex"></div>
            </div>


            <form method="POST" action="{{route('profile.info')}}" id="current-form" class="mt-4" enctype="multipart/form-data">
                @csrf

                <div class="card-body pb-5">
                    <div class="row mt-4">
                        <div class="col-md-3 my-profile">
                            <div class="profile-name"id="ProfleImage">
                                <img src="{{$user->getPhoto()}}" height="200" width="200" style="border-radius: 100%" alt="">
                            </div>
                            <div class="col-sm-12">
                                <input type="file" id="photo" name="photo" class="form-control" onchange="profileImage(event)">
                            </div>
                            <span class="text-warning errors" data-name="photo"></span>
                        </div>

                        <div class="col-md-9 right-part" style="margin-top: -16px;">
                            <div class="edit-right-part-form">


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/user.svg') }}" alt="">
                                            <label for="" class="form-label">Full Name</label>
                                            <input type="text" id="name"  name="name" class="change-input" value="{{ $user->name }}" placeholder="Full Name">
                                            <span class="text-warning errors" data-name="name">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                                            <label for="" class="form-label">Mobile Number</label>
                                            <input type="number" id="phone_number" name="phone_number" class="change-input" value="{{ $user->phone_number }}" placeholder="Mobile">
                                            <span class="text-warning errors" data-name="phone_number">{{ $errors->first('phone_number') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/sms.svg') }}" alt="">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="change-input" value="{{ $user->email }}" placeholder="Email">
                                            <span class="text-warning errors" data-name="email">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-secondary btn-submit mt-5">Update</button>

                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('frontend.profile.scripts.update-profile-script')
@endpush
