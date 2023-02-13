<div class="main-header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <div class="nav-toggle" id="menu-btn">
                <button class="btn btn-toggle toggle-sidebar mt-2" style="box-shadow: none">
                    <i class="icon-menu"></i>
                </button>
            </div>
            {{-- <a class="navbar-brand- admin-navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_navbar.svg') }}" alt=" Logo" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <div class="collapse navbar-collapse middle-nav-item" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <div class="notification">
                        <img src="{{ asset('images/notification.svg') }}" alt="" style="    height: 35px; width: 35px;">
                        <span>10</span>
                    </div>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link login-button" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link register-button" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                    @else
                        <li class="nav-item dropdown admin-dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle px-3 link" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(isset(Auth::user()->workshop->name))
                                    <img src="{{ auth()->user()->workshop->getLogo() }}" class="user-image" alt="Logo">
                                    {{ Auth::user()->workshop->name }}
                                @else
                                    <img src="{{auth()->user()->getPhoto()}}" class="user-image" alt="User Image">
                                    {{ Auth::user()->name }}
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu" aria-labelledby="navbarDropdown">
                                {{--<a class="dropdown-item" href="{{ route('profile-update') }}">
                                    <img src="{{ asset('images/user-octagon.svg') }}" alt="">
                                    Update Profile
                                </a>--}}

                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <img src="{{ asset('images/user-octagon.svg') }}" alt="">
                                    Dashboard
                                </a>

                                <a class="dropdown-item" href="{{ route('profile.info') }}">
                                    <img src="{{ asset('images/profile2.svg') }}" alt="">
                                     Profile Update
                                </a>


                                <a class="dropdown-item" href="{{ route('profile.password') }}">
                                    <img src="{{ asset('images/Password.svg') }}" alt="">
                                    Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('images/logout.svg') }}" alt="">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
</div>
