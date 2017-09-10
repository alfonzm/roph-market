<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>ROPH Market</title>
</head>
<body>
    @include('commons.header')
    
    <div id="app">
       @yield('content')
    </div>

    @include('commons.footer')
   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
