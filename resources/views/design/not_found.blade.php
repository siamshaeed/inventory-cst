<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}">
    <meta name="user_id" content="{{ auth()->id() }}">

    <title>Driver Khoji</title>

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

<body class="not-found">
    <div class="content-container">
        <img src="{{ asset('images/icon/404.jpg') }}" alt="" class="d-block mx-auto">
        <h3>OPPS! PAGE NOT FOUND</h3>
        <a href="{{route('home')}}"> BACK TO HOME</a>
    </div>

</body>

</html>
