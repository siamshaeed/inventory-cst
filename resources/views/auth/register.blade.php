@extends('layouts.auth')

@section('content')
    <div class="banner d-flex">
        <div class="img-part mt-5">
            <img src="{{ asset('images/car.png') }}" alt="">
        </div>
        <div class="form-part mt-5 reg-form-part">

            <h2>{{ __('Register') }}</h2>
            <p>Sign up with your mobile number for registration</p>

            <div class="">
                <form method="POST" action="{{ route('register') }}" id="form-workshop">
                    @csrf

                    <input type="hidden" name="register_previous_url" value="{{ \Illuminate\Support\Facades\Session::get('register_previous_url') }}">

                    <div class="row">
                        <label for="name" class="form-label"><b>{{ __('Name') }}</b></label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/user.svg') }}" alt="">
                            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Enter name" required>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label for="mobile" class="form-label"><b>{{__('Mobile Number')}}</b></label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                            <input type="number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Eg. 01737835825" required>
                            @error('phone_number')
                            <span class="text-warning fa fa-warning">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="row mt-2">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                        <div class="full-name">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}"  autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="row mt-2">
                        <label for="password" class="form-label"><b>{{ __('Password') }}</b></label>

                        <div class="full-name">
                             <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password"  autocomplete="new-password" placeholder="Enter password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <label for="password-confirm" class="form-label"><b>{{ __('Confirm Password') }}</b></label>

                        <div class="full-name">
                             <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                            <input id="password-confirm" type="password" class="" name="password_confirmation"
                                 autocomplete="new-password" placeholder="Enter same password" required>
                        </div>
                    </div>


                    <label for="workshop_name" class="form-label text-success mt-4"><b>{{ __('Do You Have Workshop ?') }} &nbsp;</b></label>
                    <input class="form-check-input workshop-checkbox mt-3"
                           type="checkbox" style="zoom: 1.4"
                           name="hasWorkshop"
                           value="1"
                    >

                    <div class="workshop-regi" id="workshop-regi">
                        <div class="row mt-2">
                            <label for="workshop_name" class="form-label"><b>{{ __('Workshop Name') }}</b></label>
                            <div class="full-name">
                                <img src="{{ asset('images/logoset/shop.svg') }}" alt="">
                                <input id="workshop_name" type="text" name="workshop_name" class=" @error('workshop_name') is-invalid @enderror"
                                       value="{{ old('workshop_name') }}"  autocomplete="workshop_name" autofocus>
                                @error('workshop_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="license_number" class="form-label"><b>{{ __('Workshop License Number') }}</b></label>
                            <div class="full-name">
                                <img src="{{ asset('images/logoset/personalcard.svg') }}" alt="">
                                <input id="license_number" type="number" name="license_number" class=" @error('license_number') is-invalid @enderror"
                                       value="{{ old('license_number') }}"  autocomplete="license_number" autofocus>
                                @error('license_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('license_number') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button type="submit" class="sign-button">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>

                 <div class="bottom-part reg-bottom-part">
                    <p>Already have an account? <a href="{{ route('login') }}"> Login</a></p>
                </div>

            </div>


        </div>
    </div>
@endsection

@push('auth-scripts')
    <script>
        $(document).ready(function () {
            const workshopRegiDiv = $(".workshop-regi");
            const formWorkshop = $("#form-workshop");
            const workshop_name = $("#workshop_name");
            const license_number = $("#license_number");
            workshopRegiDiv.hide();
            $(".workshop-checkbox").click(function() {
                if($(this).is(":checked")) {
                    workshopRegiDiv.show();
                } else {
                    workshopRegiDiv.hide();
                    // workshop_name.prop('',false)
                    // license_number.prop('',false)
                }
            });

        })
    </script>
@endpush
