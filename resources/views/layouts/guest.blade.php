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
        {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div> --}}
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
    </body>
</html>
