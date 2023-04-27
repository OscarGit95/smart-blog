<x-app-layout>
    @stack('styles')
        <link href="{{ asset('css/blog/blog.css') }}" rel="stylesheet">
   
    <x-slot name="header">
        <p class="header_secondary__username">¡Bienvenid@ {{ Auth::user()->userInformation->username }}! </p>
        <h1 class="header_secondary__title">Blogs</h1>
    </x-slot>

    <section class="blog_container">
        <form action="{{ route('blog.store') }}" method="POST" id="form_save_blog">
            @csrf
            <div class="request_container">
                <div class="form_blog_container">
                    <input type="text" class="form_blog__input" name="topic" id="topic" placeholder="Busca o ingresa un tema para tu blog">
                    <button type="button" class="form_chatgpt__button" id="request_chatgpt_button">ChatGPT</button>
                </div>
                <div class="response_container">
                    <div class="chatgpt_response_container">
                        <textarea name="chatgpt_response" id="chatgpt_response" class="form_blog__textarea" cols="30" rows="10"></textarea>
                    </div>
                    <div class="save_blog_container">
                        <div class="form_blog__group">
                            <input type="date" name="blog_date" id="blog_date" class="form_blog__input_date">
                            <label for="blog_date" class="form_blog__label">Expira en *</label>
                        </div>
                        <div class="form_save__button_container">
                            <button type="submit" id="save_blog__button" class="form_save__button">Guardar blog</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="list_blog_container">
            sdfsdfsdfsdf
        </div>
    </section>
    <input id="baseUrl" type="hidden" value="{{ \Request::root() }}">

    @section('script')
        <script src="{{asset('js/blog/blog.js')}}"></script>
        @if(session('success'))
            <script>
                swal({
                    title: "Posteado 😉",
                    text: "{{session('success')}}",
                    type: "success",
                });
            </script>
        @endif
        @if(session('errors'))
            <script>
                swal({
                    title: "Ups 😶‍🌫️",
                    text: "{{session('errors')}}",
                    type: "error",
                });
            </script>
        @endif
    @endsection

</x-app-layout>