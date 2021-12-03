<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (auth()->check())
    <meta name="username" content="{{ auth()->user()->name }}" />
    <meta name="hasApplied" content="{{ auth()->user()->has_applied }}" />
    <meta name="email" content="{{ auth()->user()->email }}" />
    <meta name="role" content="{{ auth()->user()->role }}" />


    @endif

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" v-cloak class="v-cloak--hidden">
        <app-container></app-container>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>


</html>