<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}">
    {{-- <meta name="workshop_id" content="{{optional(auth()->user()->workshop)->id}}"> --}}
    <!-- Font aso -->
    <title>Inventory Software</title>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/AdminLTE.min.css') }}">
    @include('partials.header')
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bundles/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('bundles/dashboard/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/all.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> --}}

    {{-- Summernote CSS CDN link --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="../../../../public/fontawesome/fontawesome.min.css" rel="stylesheet">

    @stack('styles')
    <style>
        .datepicker {
            padding: 10px 20px;
        }
    </style>
</head>

<body class="dashboard-body">

    @include('partials.navbar')

    <div class="container-fluid">

        @include('partials.sidebar')

        <main class="main-panel">

            @yield('content')

        </main>
    </div>


    {{-- Dynamic Modal Define --}}
    @include('partials.accessory')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @include('partials.scripts')
    @include('vendor.lara-izitoast.toast')


    @stack('scripts')

    {{-- Summernote js link --}}
    @include('plugin.summernote')
    <script>
        $('#menu-btn').click(function() {
            $('#sidebarMenu').toggleClass("active1");
            $('.main-header').toggleClass("active3");
            $('.main-panel').toggleClass("active2");
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format: 'dd-mm-yyyy'
            });
            $('#datepicker2').datepicker({
                format: 'dd-mm-yyyy'
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>

</html>
