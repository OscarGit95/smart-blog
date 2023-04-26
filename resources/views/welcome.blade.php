<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Smart Blog</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="{{asset('images/identity/smart_blog_icon.png')}}">

        <link href="{{ asset('css/welcome/styles.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container_welcome">
            <nav>
                <img src="{{ asset('images/identity/smart_blog_icon.png') }}" alt="Smart Blog icon">
                <ul>
                    <li><a href="{{ route('register') }}">Regístrate</a></li>
                </ul>
            </nav>
            <video autoplay loop muted plays-inline class="background_video">
                <source src="{{ asset('videos/smart_blog_video_welcome.mp4') }}" type="video/mp4">
            </video>
            <div class="content_welcome">
                <img src="{{ asset('images/identity/smart_blog_logo.png') }}" alt="Smart Blog logo">
                <div class="content_buttons">
                    <a href="{{ route('login') }}">Inicia sesión</a>
                </div>
            </div>
        </div>
    </body>
</html>
