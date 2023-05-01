<header class="header">
    <div class="nav__logo">
        <a href="/">
            <img src="{{ asset('images/identity/smart_blog_icon.png') }}"  alt="Smart blog logo">
        </a>
    </div>
    <nav>
        <ul class="nav__links">
            <li><a href="/">Inicio</a></li>
            <li><a href="{{ route('blog.index') }}">Blogs</a></li>
        </ul>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a 
            class="nav__button" 
            href="{{route('logout')}}" 
            onclick="event.preventDefault();
            this.closest('form').submit();">Cerrar sesión</a>
    </form>
    <a href="#" onclick="openNavBar()" class="nav__menu_responsive">Menú</a>
    <div class="overlay" id="nav__mobile_menu">
        <a href="#" onclick="closeNavBar()" class="close_menu_responsive">&times;</a>
        <div class="overlay__content">
            <a href="/">Inicio</a>
            <a href="{{ route('blog.index') }}">Blogs</a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <a 
                href="{{route('logout')}}" 
                onclick="event.preventDefault();
                this.closest('form').submit();">
                    Cerrar sesión
                </a>
            </form>
        </div>
    </div>
</header>