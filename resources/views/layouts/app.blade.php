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
            @include('components.header')
            <main class="main">
                @yield('content')
            </main>
            @include('components.footer')
        </div>
        @include('layouts.modals')
        @yield('page-modal')
        <div class="loader fixed" id="loader" hidden>
            <div class="loader__icon"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    @yield('page-script')
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
