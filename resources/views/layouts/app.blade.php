<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('styles/main.min.css')}}">
    <script>
        var BASE_URL = '{{ url("/") }}';
    </script>
</head>
<body>
    <div id="app">
        <div class="wrapper">
            @include('header')
            <main class="main">
                @yield('content')
            </main>
            @include('footer')
        </div>
        @include('layout.modals')
        @yield('page-modal')
        <div class="loader fixed" id="loader" hidden>
            <div class="loader__icon"></div>
        </div>
    </div>
	{{-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> --}}
    <script src="{{asset('scripts/bootstrap.bundle.min.js')}}"></script>
    @yield('page-script')
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
