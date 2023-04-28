<x-app-layout>
    @stack('styles')
        <link href="{{ asset('css/dashboard/dashboard.css') }}" rel="stylesheet">

    <x-slot name="header">
        <p class="header_secondary__username">¡Bienvenid@ {{ Auth::user()->userInformation->username }}! </p>
        <div>
            <h1 class="header_secondary__title">Inicio</h1>
        </div>
    </x-slot>

    {{-- <section class="empty_blogs">
        <h1>Tu inicio se ve algo vacío</h1>
        <a href="/blog">¡Publica un blog!</a>
        <video autoplay muted loop id="background__video">
            <source src="{{ asset('videos/empty_blogs_black.mp4') }}" type="video/mp4">
        </video>
    </section> --}}
    <section class="list_blog_container">
        <div class="blogs_published_container">
            @foreach($blogs as $blog)
                <div class="blog">
                    <div class="blog_header">
                        <h1>{{ $blog->topic }}</h1>
                    </div>
                    <div class="blog_content">
                        <p>{!! nl2br(e($blog->blog)) !!}</p>
                    </div>
                    <div class="blog_footer">
                        <p>{{\Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</p>
                        <p>expira el {{\Carbon\Carbon::parse($blog->expires_at)->formatLocalized('%d de %B, %Y')}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
