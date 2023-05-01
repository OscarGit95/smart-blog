<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <link rel="icon" type="image/png" href="{{asset('images/identity/smart_blog_icon.png')}}">
        <link href="{{ asset('css/guest/guest.css') }}" rel="stylesheet">
    </head>
    <body>
        <video autoplay muted loop id="background__video">
            <source src="{{ asset('videos/smart_blog_video_welcome.mp4') }}" type="video/mp4">
        </video>
        <div class="container">
            <div class="logo__container">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>
            <div class="form__section">
                {{ $slot }}
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>
