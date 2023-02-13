@extends('layouts.auth')

@section('content')
    <div class="banner d-flex login-banner">
        <div class="img-part mt-5">
            <img src="{{ asset('images/car.png') }}" alt="">
        </div>
        <div class="form-part">
            <h2>{{ __('OTP-Send') }}</h2>
            <p>Enter your valid mobile number</p>
            <div class="">
                <form method="POST" action="{{ route('otp.again') }}">
                    @csrf
                    <div class="row mt-2">
                        <label for="mobile" class="form-label">Mobile Number</label>

                        <div class="full-name">
                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                            <input type="number" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="" required autofocus>
                            @error('phone_number')
                            <span class="text-warning fa fa-warning">{{ $message }}</span>
                            @enderror

                            <span class="text-warning">
                                {{ \Illuminate\Support\Facades\Session::get('msg_error') }}
                            </span>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="sign-button">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
