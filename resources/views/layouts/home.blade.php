<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <title>MADSIS | @yield('title','Induccion')</title>
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
    <body  class="@yield('body_class','')mini-navbar" ><!--Agregamos una clase al body por default-->
    <div id="app"><!--Inicio Div para Vue.js -->
        <!--Inicio menu dashboard-->
            @include('menu.index')
        <!--Fin menu dashboard-->
        <div id="page-wrapper" class="gray-bg">
            <!--Inicio Header-->
            @include('header.index')
            <!--Fin Header-->
            <!--Inicio Contenido-->
            @yield('content')
            @include('popup.UserComplete')
            <!--Fin Contenido-->
            <!--Inicio Footer-->
            @include('footer.index')
            <!--Fin Footer-->
        </div>
    </div><!--Fin Div para Vue.js -->
    <!-- Inicio scripts -->
    <script src="{{ mix('storage/siec/dist/js/app.js') }}"></script><!--Laravel JS Script Default -->
    <script src="{{ asset('storage/siec/dist/js/signature_pad.min.js') }}"></script><!--Signature PAD JS Script -->
    @yield('scripts.form')
    <!-- Fin scripts -->
</body>
</html>