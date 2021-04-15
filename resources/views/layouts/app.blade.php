<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fast-xml-parser/3.16.0/parser.min.js'>
    <script src="{{ asset('js/filter_form/modernizr.custom.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/filter_form/component.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.header')
        <main class="py-4">
            <div class="container w-4/12" style="position: absolute; z-index: 20; right: 33px; top: 54px;">
                <div id="sb-search" class="sb-search">
                    <form>
                        <input class="sb-search-input" placeholder="What will it look for?" type="text" value="" name="search" id="search">
                        <input class="sb-search-submit" type="submit" value="">
                        <span class="sb-icon-search"></span>
                    </form>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/filter_form/classie.js')}}"></script>
    <script src="{{ asset('js/filter_form/uisearch.js')}}"></script>
    <script>
        new UISearch( document.getElementById( 'sb-search' ) );
    </script>
    @component('site.components.modal-currency')@endcomponent
</body>
</html>
