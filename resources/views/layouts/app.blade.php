<!DOCTYPE html>
<html lang="ru">
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
    <div class="wrapper">
        @yield('header')
        <main class="main">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
        @include('layouts.footer')
        {{-- @include('layouts.modals') --}}
        @yield('page-modal')
    </div>
	<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{asset('scripts/bootstrap.bundle.min.js')}}"></script>
    @yield('page-script')
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>