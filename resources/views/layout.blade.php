<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <title>Ragna Market</title>
</head>
<body>
    <div id="app" v-cloak>
        @include('commons.header')
        @yield('content')
        @include('commons.footer')
    </div>
   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
