<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{asset('images/identity/smart_blog_icon.png')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
       
        <link href="{{ asset('css/app/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navbar/navbar.css') }}" rel="stylesheet">

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="header_secondary">
                {{ $header }}
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <script src="{{asset('js/navbar/navbar.js')}}"></script>

    </body>
</html>
