<nav class="profile-aside">
    <div class="profile-aside__header">
        <div class="profile-aside__avatar">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="profile-aside__user">
            <div class="profile-aside__name">
                {{ Auth::user()->name ?? 'Гость' }}
            </div>
            <div class="profile-aside__email">
                {{ Auth::user()->email ?? '' }}
            </div>
        </div>
    </div>

    <div class="profile-aside__list">
        <a href="{{ route('profile.index') }}"
           class="profile-aside__link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
            <i class="bi bi-person"></i>
            <span>Основная информация</span>
        </a>

        <a href="{{ route('profile.address') }}"
           class="profile-aside__link {{ request()->routeIs('profile.address') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i>
            <span>Адрес доставки</span>
        </a>

        <a href="{{ route('profile.password') }}"
           class="profile-aside__link {{ request()->routeIs('profile.password') ? 'active' : '' }}">
            <i class="bi bi-shield-lock"></i>
            <span>Смена пароля</span>
        </a>

        <a href="{{ route('profile.history') }}"
           class="profile-aside__link {{ request()->routeIs('profile.history') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i>
            <span>История заказов</span>
        </a>
    </div>

    <div class="profile-aside__divider"></div>

    <a href="{{ route('logout') }}" class="profile-aside__link profile-aside__link--danger">
        <i class="bi bi-box-arrow-right"></i>
        <span>Выйти</span>
    </a>
</nav>
