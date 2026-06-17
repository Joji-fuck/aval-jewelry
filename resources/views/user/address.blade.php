@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <section class="profile-page">
        <div class="container">
            <h1 class="profile-page__title">Профиль</h1>

            <div class="profile">
                <aside class="profile-left">
                    @include('user.layout.aside')
                </aside>

                <form class="profile-right profile-card" action="{{ route('profile.address.update') }}" method="post">
                    @csrf
                    @method('PATCH')

                    @if (session('success'))
                        <div class="profile-alert profile-alert--success">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ session('success') }}</span>
                            <button type="button" class="profile-alert__close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif

                    <div class="profile-card__header">
                        <h2 class="profile-card__title">Адрес доставки</h2>
                        <p class="profile-card__subtitle">Заполните данные для оформления заказов</p>
                    </div>

                    <div class="profile-form">
                        <div class="profile-form__group">
                            <label class="profile-form__label" for="country">Страна</label>
                            <input id="country" type="text" class="profile-form__input"
                                   name="country" placeholder="Введите страну"
                                   value="{{ $profile->country }}">
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="city">Город</label>
                            <input id="city" type="text" class="profile-form__input"
                                   name="city" placeholder="Введите город"
                                   value="{{ $profile->city }}">
                        </div>

                        <div class="profile-form__row">
                            <div class="profile-form__group">
                                <label class="profile-form__label" for="street">Улица</label>
                                <input id="street" type="text" class="profile-form__input"
                                       name="street" placeholder="Введите улицу"
                                       value="{{ $profile->street }}">
                            </div>

                            <div class="profile-form__group profile-form__group--small">
                                <label class="profile-form__label" for="house_number">Дом</label>
                                <input id="house_number" type="text" class="profile-form__input"
                                       name="house_number" placeholder="№"
                                       value="{{ $profile->house_number }}">
                            </div>
                        </div>

                        <div class="profile-form__group profile-form__group--small">
                            <label class="profile-form__label" for="zip_code">Индекс</label>
                            <input id="zip_code" type="text" class="profile-form__input"
                                   name="zip_code" placeholder="000000"
                                   maxlength="6" inputmode="numeric"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,6)"
                                   value="{{ $profile->zip_code }}">
                        </div>
                    </div>

                    <div class="profile-card__footer">
                        <button class="profile-button profile-button--primary" type="submit">
                            <i class="bi bi-check2"></i>
                            Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
