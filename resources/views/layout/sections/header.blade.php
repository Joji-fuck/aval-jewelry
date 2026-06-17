
<nav class="navbar sticky-top">
    <a href="{{ route('home') }}" class="navbar-logo">
        <img src="{{ asset('images/logo-white.png') }}" alt="logo">
    </a>

    <button class="burger " id="burger" aria-label="Меню" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-menu" id="navMenu">
        <li><a href="{{ route('catalog.index') }}">Каталог</a></li>
        <li><a href="{{ route('about.index') }}">О нас</a></li>
        <li><a href="/constructor">Конструктор колец</a></li>
        <li>
            <a href="{{ route('cart.index') }}" class="cart-link">
                Корзина
                @if(session('cart'))
                    <span class="badge rounded-pill bg-danger">{{ count(session('cart')) }}</span>
                @endif
            </a>
        </li>
        @guest
            <li><a href="{{ route('login.index') }}">Вход</a></li>
        @endguest
        @auth
            <li><a href="{{ route('profile.index') }}">Профиль</a></li>
        @endauth
    </ul>
</nav>
