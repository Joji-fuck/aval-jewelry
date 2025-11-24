<nav>
    <ul>
        <li><a href="{{route('catalog.index')}}">Каталог</a></li>
        <li><a href="#">О нас</a></li>
        <li><a href="{{route('home')}}"><img src="{{asset('images/logo-white.png')}}" alt="logo"></a></li>
        <li><a href="#">Контакты</a></li>
        @guest
            <li><a href="{{route('login.index')}}">Вход</a></li>
        @endguest
        @auth
            <li><a href="{{route('profile.index')}}">Профиль</a></li>
            <li><a href="{{route('logout')}}">Выход</a></li>
        @endauth
    </ul>
</nav>
