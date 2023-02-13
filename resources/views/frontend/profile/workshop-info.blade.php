@extends('layouts.master')

@section('content')

    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('workshop.info') }}" class="link">
                            {{ __('Workshop Info') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex"></div>
            </div>


            <form method="POST" action="{{route('workshop.info')}}" id="current-form" class="mt-4"
                  enctype="multipart/form-data">
                @csrf

                <div class="card-body pb-5">
                    <div class="row mt-4">
                        <div class="col-md-3 my-profile">
                            <div class="profile-name" id="ProfleImage">
                                <img src="{{$workshop->getLogo()}}" height="200" width="200" style="border-radius: 100%"
                                     alt="">
                            </div>
                            <div class="col-sm-12 mt-2">
                                <input type="file" id="logo" name="logo" class="form-control"
                                       onchange="profileImage(event)">
                            </div>
                            <span class="text-warning errors" data-name="logo"></span>
                        </div>

                        <div class="col-md-9 right-part" style="margin-top: -16px;">
                            <div class="edit-right-part-form">


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/user.svg') }}" alt="">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" id="name" name="name" class="change-input"
                                                   value="{{ $workshop->name }}" placeholder="Full Name">
                                            <span class="text-warning errors"
                                                  data-name="name">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/user.svg') }}" alt="">
                                            <label for="" class="form-label">License number</label>
                                            <input type="text" id="license_number"
                                                   name="license_number"
                                                   class="change-input"
                                                   value="{{ $workshop->license_number }}" placeholder="License number">
                                            <span class="text-warning errors"
                                                  data-name="license_number">{{ $errors->first('license_number') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                                            <label for="" class="form-label">Mobile Number</label>
                                            <input type="number" id="contact_no" name="contact_no" class="change-input"
                                                   value="{{ $workshop->contact_no }}" placeholder="Mobile">
                                            <span class="text-warning errors"
                                                  data-name="contact_no">{{ $errors->first('contact_no') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/sms.svg') }}" alt="">
                                            <label for="" class="form-label">Address</label>
                                            <input type="text" id="address" name="address" class="change-input"
                                                   value="{{ $workshop->address }}" placeholder="Address">
                                            <span class="text-warning errors"
                                                  data-name="address">{{ $errors->first('address') }}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                                            <label for="" class="form-label">Latitude</label>
                                            <input type="text" id="latitude" name="latitude" class="change-input"
                                                   value="{{ $workshop->latitude }}" placeholder="Latitude">
                                            <span class="text-warning errors"
                                                  data-name="latitude">{{ $errors->first('latitude') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/sms.svg') }}" alt="">
                                            <label for="" class="form-label">Longitude</label>
                                            <input type="text" id="longitude" name="longitude" class="change-input"
                                                   value="{{ $workshop->longitude }}" placeholder="Longitude">
                                            <span class="text-warning errors"
                                                  data-name="longitude">{{ $errors->first('longitude') }}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea id="description"
                                                      name="description" class="form-control" rows="4"
                                            >{{$workshop->description}}</textarea>
                                            <span class="text-warning errors"
                                                  data-name="description">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>





                                <button type="submit" class="btn btn-secondary btn-submit mt-5">Update</button>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div id="control">
                                            <input id="search-box" type="text" size="50"
                                                   placeholder="Your Location"
                                                   autocomplete="on" runat="server"/>
                                        </div>

                                        <div id="map"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #map {
            height: 300px;
        }

        #search-box {
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
            font-size: 15px;
            border-radius: 3px;
            border: 0;
            margin-top: 10px;
            width: 270px;
            height: 40px;
            text-overflow: ellipsis;
            padding: 0 1em;
        }
    </style>
@endpush

@push('scripts')
    {{--<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5WQW9fdx6uzx85zLVwfq7mmHDTRmIYi8&libraries=places&callback=initMap"></script>--}}

    @include('frontend.workshops.map-locate-scripts')
    @include('frontend.profile.scripts.update-workshop-script')
@endpush
