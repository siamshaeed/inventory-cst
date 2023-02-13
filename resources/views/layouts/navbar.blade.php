<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}">
    <meta name="user_id" content="{{ auth()->id() }}">

    <title>Inventory Software</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/setting.svg') }}">

    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bundles/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Font aso -->
    <script src="https://kit.fontawesome.com/a627728a7c.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>

<body>
    <div id="app">
        {{--@include('layouts.navbar.navbar')--}}

        <main class="mb-0">
            @yield('content')
        </main>

        {{--@include('layouts.navbar.footer')
        @include('layouts.navbar.accessory')--}}



    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('bundles/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    <script src="{{ asset('js/custom-navbar.js') }}"></script>
    <script src="{{ asset('js/user-notification.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    @include('vendor.lara-izitoast.toast')


    @stack('scripts')
    <script>
        class CountUp {
            constructor(triggerEl, counterEl) {
                const counter = document.querySelector(counterEl)
                const trigger = document.querySelector(triggerEl)
                let num = 0

                const countUp = () => {
                    if (num <= counter.dataset.stop)
                        ++num
                    counter.textContent = num
                }

                const observer = new IntersectionObserver((el) => {
                    if (el[0].isIntersecting) {
                        const interval = setInterval(() => {
                            (num < counter.dataset.stop) ? countUp(): clearInterval(interval)
                        }, counter.dataset.speed)
                    }
                }, {
                    threshold: [0]
                })

                observer.observe(trigger)
            }
        }

        // Initialize any number of counters:
        new CountUp('#start1', '#counter1')
        new CountUp('#start2', '#counter2')
        new CountUp('#start3', '#counter3')
        new CountUp('#start4', '#counter4')
        new CountUp('#start5', '#counter5')
        new CountUp('#start6', '#counter6')
    </script>
</body>

</html>
