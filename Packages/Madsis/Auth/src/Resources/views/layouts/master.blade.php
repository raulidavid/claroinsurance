<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>MADSIS | @yield('title','Market')</title>
    <!-- Inicio Styles -->
@include('styles.index')
<!-- Fin Styles -->
@if (env('APP_ENV')=='Production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-73183606-3"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-73183606-3');
        </script>
    @endif
</head>
<body class="@yield('body_class','gray-bg')" ><!--Agregamos una clase al body por default-->
<div id="app">
    @yield('content')
</div>
<!-- Inicio scripts -->
<script src="{{ mix('storage/siec/dist/js/app.js') }}"></script><!--Laravel JS Script Default -->
@yield('scripts.form')
<!-- Fin scripts -->
</body>
</html>