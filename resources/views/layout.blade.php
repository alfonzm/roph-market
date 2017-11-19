<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109560580-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109560580-1');
    </script>

    <!-- Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <title>Ragna-Market.com</title>

    <!-- Open graph data -->
    <meta property="og:title" content="Ragna-Market.com" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ragna-market.com/" />
    <meta property="og:image" content="https://ragna-market.com/img/screenshot.png" />
    <meta property="og:keywords" content="ragnarok, ragna, ragnarok, online, market, philippines, roph, pro, sell, buy, items, vend, vending, thor, loki, chaos" />
    <meta property="og:description" content="Ragna-Market.com is a virtual marketplace for Ragnarok Online Philippines where you can set up a stall to sell your items, or search for items you're looking to buy." />

    <!-- Twitter card data -->
    <meta name="twitter:card" value="summary_large_image">
    <meta name="twitter:image" value="https://ragna-market.com/img/screenshot.png">
    <meta name="twitter:image:src" value="https://ragna-market.com/img/screenshot.png">
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
