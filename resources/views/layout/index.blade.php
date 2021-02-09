<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffc107">

    <script src="{{ asset('mailing/js/app.js') }}" defer></script>
    <link href="{{ asset('mailing/css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    <v-app style="background-color: rgb(255,253,244);">
        <v-main>
            @yield('content')
        </v-main>
    </v-app>
</div>
</body>
</html>
