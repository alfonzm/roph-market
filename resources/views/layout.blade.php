<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <title>ROPH Market</title>
</head>
<body>
    <h1><a href="{{ route('index') }}">ROPH Market</a></h1>

    <nav>
        @if (Auth::check())
        <a href="{{ route('stalls.create') }}">Create a Stall</a>
        <a href="{{ route('logout') }}">Logout</a>
        @else
        <a href="{{ route('login') }}">Login</a>
        @endif
    </nav>
    
    <div id="app">
       @yield('content')
   </div>
   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
