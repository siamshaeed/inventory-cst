@extends('layouts.navbar')

@section('content')
    <div class="banner d-flex login-banner">
        <div class="img-part mt-5">
            <img src="{{ asset('images/inventory.jpg') }}" alt="" width="700">
        </div>
        <div class="form-part">
            <h2>{{ __('Login') }}</h2>
            {{-- <p>Sign in with your mobile number</p> --}}
            <div class="">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- <input type="text" name="previous_url_define" value="{{ url()->previous() }}"> --}}

                    <div class="row mt-2">
                        <span class="text-warning">
                            <b>{{ \Illuminate\Support\Facades\Session::get('phone_number') }}</b>
                        </span>

                        <label for="mobile" class="form-label">Mobile Number</label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                            <input type="text" id="phone_number" name="phone_number" placeholder="Enter number" required
                                autofocus>
                            @error('phone_number')
                                <span class="text-warning fa fa-warning">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label text-start" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="sign-button">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                {{-- <div class="bottom-part">
                    <p>Don’t have an account? <a href="{{ route('register') }}"> Register</a></p>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.navbar')

@section('content')
    <div class="banner d-flex login-banner">
        <div class="img-part mt-5">
            <img src="{{ asset('images/inventory.jpg') }}" alt="" width="700">
        </div>
        <div class="form-part">
            <h2>{{ __('Login') }}</h2>
            {{-- <p>Sign in with your mobile number</p> --}}
            <div class="">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- <input type="text" name="previous_url_define" value="{{ url()->previous() }}"> --}}

                    <div class="row mt-2">
                        <span class="text-warning">
                            <b>{{ \Illuminate\Support\Facades\Session::get('phone_number') }}</b>
                        </span>

                        <label for="mobile" class="form-label">Mobile Number</label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/call.svg') }}" alt="">
                            <input type="text" id="phone_number" name="phone_number" placeholder="Enter number" required
                                autofocus>
                            @error('phone_number')
                                <span class="text-warning fa fa-warning">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="full-name">
                            <img src="{{ asset('images/logoset/lock.png') }}" alt="">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label text-start" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="sign-button">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                {{-- <div class="bottom-part">
                    <p>Don’t have an account? <a href="{{ route('register') }}"> Register</a></p>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
