<div class="list-group">
    <a href="{{route('profile.index')}}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.index') ? 'active' : '' }}">Основная информация</a>
    <a href="{{route('profile.address')}}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.address') ? 'active' : '' }}">Адрес доставки</a>
    <a href="{{route('profile.password')}}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.password') ? 'active' : '' }}">Смена пароля</a>
    <a href="{{route('profile.history')}}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.history') ? 'active' : '' }}">История заказов</a>
    <a href="{{route('logout')}}" class="list-group-item list-group-item-action">Выйти</a>
</div>
