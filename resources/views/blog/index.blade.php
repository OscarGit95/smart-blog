<x-app-layout>
    @stack('styles')
        <link href="{{ asset('css/blog/blog.css') }}" rel="stylesheet">
   
    <x-slot name="header">
        <p class="header_secondary__username">¡Bienvenid@ {{ Auth::user()->userInformation->username }}! </p>
        <div>
            <h1 class="header_secondary__title">Blogs</h1>
        </div>
    </x-slot>

    <section class="blog_container">
        <div>
            <form action="{{ route('blog.store') }}" method="POST" id="form_save_blog">
                @csrf
                <div class="request_container">
                    <div class="form_blog_container">
                        <input type="text" class="form_blog__input" name="topic" id="topic"  value="{{ old('topic')}}" placeholder="Busca o ingresa un tema para tu blog">
                        <button type="button" class="form_chatgpt__button" id="request_chatgpt_button">ChatGPT</button>
                    </div>
                    <div class="response_container">
                        <div class="chatgpt_response_container">
                            <textarea name="chatgpt_response" id="chatgpt_response" class="form_blog__textarea" cols="30" rows="10">{{{ old('chatgpt_response') }}}</textarea>
                        </div>
                        <div class="save_blog_container">
                            <div class="form_blog__group">
                                <input type="date" name="blog_date" id="blog_date" value="{{ old('blog_date') }}" class="form_blog__input_date">
                                <label for="blog_date" class="form_blog__label">Expira en *</label>
                            </div>
                            <div class="form_save__button_container">
                                <button type="submit" id="save_blog__button" class="form_save__button">Publicar blog</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="list_blog_container">
            @if($blogs->isEmpty())
                <div class="empty_blog_container">
                    <h1>Parece que no tienes blogs</h1>
                    <h1>¡Publica uno!</h1>
                    <video autoplay muted loop id="background__video">
                        <source src="{{ asset('videos/empty_blogs.mp4') }}" type="video/mp4">
                    </video>
                </div>
            @else
                <div class="my_blogs_container">
                    <h1>Mis blogs 🤖</h1>
                </div>
                <div class="search_container">
                    <input type="text" class="form_search__input" name="search_topic" id="search_topic" placeholder="Buscar por tema">
                </div>
                <div class="blogs_published_container">
                    @include('blog.blogs')
                </div>
            @endif
        </div>
        <!-- Modal section -->
        <section class="modal">
            <div class="modal__container">
                <form method="POST" id="form_edit_blog">
                @csrf
                @method('PUT')
                    <div class="modal__title">
                        <h2>Editar blog</h2>
                    </div>
                    <div class="modal__content">
                        <div class="edit_topic__container">
                            <input type="text" class="form_blog__input" name="edit_topic" id="edit_topic" placeholder="Busca o ingresa un tema para tu blog">
                            <button type="button" class="form_chatgpt__button" id="modal_chatgpt_button">ChatGPT</button>
                        </div>
                        <div class="edit_content__container">
                            <div>
                                <textarea name="edit_blog_content" id="edit_blog_content" class="form_blog__textarea" cols="30" rows="10"></textarea>
                            </div>
                            <div class="save_blog_container">
                                <div class="form_blog__group">
                                    <input type="date" name="edit_blog_date" id="edit_blog_date" class="form_blog__input_date">
                                    <label for="edit_blog_date" class="form_blog__label">Expira en *</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="close__container">
                        <button type="button" class="close__modal">Cerrar</button>
                        <button type="submit" class="update__blog">Actualizar blog</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
    <input id="baseUrl" type="hidden" value="{{ \Request::root() }}">

    @section('script')
        <script src="{{asset('js/blog/blog.js')}}"></script>
        @if(session('success_function'))
            <script>
                Swal.fire({
                    title: "¡Listo 😉!",
                    text: "{{session('success_function')}}",
                    icon: "success",
                });
            </script>
        @endif
        @if(session('errors_function'))
            <script>
                Swal.fire({
                    title: "Ups 😶‍🌫️",
                    text: "{{session('errors_function')}}",
                    icon: "error",
                });
            </script>
        @endif
        @if($errors->any())
            <script>
                let listItems = '';
                
                @json($errors->all()).map((items) => {
                    listItems += `<li>${items}</li>`;
                });
                console.log(listItems);
                Swal.fire({
                    title: "Ups 😶‍🌫️",
                    html: `<ul>${listItems}</ul>`,
                    icon: "error",
                });
            </script>
        @endif
    @endsection

</x-app-layout>