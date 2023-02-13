@extends('layouts.master')

@section('content')

    <div class="mt-3">
        <div class="content-container">

            <div class="header d-flex justify-content-between">
                <div class="head-left d-flex">
                    <span></span>
                    <p class="mb-0 ms-1">
                        <a href="{{ route('profile.password') }}" class="link" data-bs-toggle="tooltip" title="{{ __('Profile Password') }}">{{ __('Profile Password') }}</a>
                    </p>
                </div>
                <div class="head-right d-flex"></div>
            </div>

            <div class="card-body pb-5">
                <div class="row mt-4">
                    <div class="col-md-3 my-profile">
                        <div class="profile-name"id="ProfleImage">
                            <img src="{{ asset('images/user2.jpg') }}" height="200" width="200" style="border-radius: 100%" alt="">
                        </div>
                        <div class="col-sm-12">
                            {{--<input type="file" id="image" name="image" class="form-control" onchange="profileImage(event)">--}}
                        </div>
                        <div class="col-sm-4">
                            {{--@if(is_null($service_category->logo))
                                <img src="{{ asset('images/service_list_logo/blank_logo.png') }}" alt="" class="img-thumbnail" width="70" height="70">
                            @else
                                <img src="{{ asset('images/service_category_logo/'.$service_category->logo) }}" alt="" class="img-thumbnail" width="70" height="70">
                            @endif--}}
                        </div>
                    </div>

                    <div class="col-md-9 right-part" style="margin-top: -16px;">
                        <div class="edit-right-part-form">

                            <form id="addFormData" class="mt-4">
                                {{ csrf_field() }}

                                <input type="hidden" id="id" name="id" value="{{ auth()->user()->id }}">

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                                            <label for="" class="form-label">Current Password</label>
                                            <input type="password" id="current_password" name="current_password" class="change-input" value="" placeholder="Enter New Password" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                                            <label for="" class="form-label">New Password</label>
                                            <input type="password" id="new_password" name="new_password" class="change-input" value="" placeholder="Enter New Password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="change-name">
                                            <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                                            <label for="" class="form-label">New Confirm Password</label>
                                            <input type="password" id="new_confirm_password" name="new_confirm_password" class="change-input" value="" placeholder="Confirm New Password" required>
                                        </div>
                                    </div>
                                </div>

                                {{--<input type="submit" value="Update" class="submit-btn mt-5">--}}
                                <button class="btn btn-secondary btn-submit mt-5">Password Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            $(".btn-submit").click(function (e){
                e.preventDefault();

                var _token          = $("input[name='_token']").val();
                var current_password        = $("#current_password").val();
                var new_password            = $("#new_password").val();
                var new_confirm_password    = $("#new_confirm_password").val();
                //alert("Hi Aleart");

                $.ajax({
                    url: "{{ route('profile.password') }}",
                    type:'POST',
                    data: {
                        _token: _token,
                        current_password: current_password,
                        new_password: new_password,
                        new_confirm_password: new_confirm_password,
                    },

                    success: function(response) {
                        if(response.status == 400){
                            //console.log(response.errors.name);
                            $.each(response.errors, function (key, err_values){
                                "use strict";
                                iziToast.error({
                                    message: err_values,
                                    position: 'topRight'
                                });
                            });

                        }else{
                            //alert(response.success);
                            //$('#addFormData').find('input').val("");

                            "use strict";
                            iziToast.success({
                                message: response.success,
                                position: 'topRight'
                            });
                        }
                    }

                });

            });

        });
    </script>

    <script type="text/javascript">
        var profileImage = function(event) {
            var src = URL.createObjectURL(event.target.files[0]);
            var ProfleImage = "<img style='height: 80px; width: 80px;'  src='"+ src +"'>";
            $("#ProfleImage").html(ProfleImage);
        };
    </script>
@endpush
