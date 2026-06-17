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

                <form class="profile-right profile-card" action="{{ route('profile.index.update') }}" method="post">
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
                        <h2 class="profile-card__title">Основная информация</h2>
                        <p class="profile-card__subtitle">Личные данные и контакты для связи</p>
                    </div>

                    <div class="profile-form">

                        <div class="profile-form__row">
                            <div class="profile-form__group">
                                <label class="profile-form__label" for="name">Имя</label>
                                <input id="name" type="text" class="profile-form__input"
                                       name="name" placeholder="Введите имя"
                                       value="{{ $profile->name }}">
                            </div>

                            <div class="profile-form__group">
                                <label class="profile-form__label" for="surname">Фамилия</label>
                                <input id="surname" type="text" class="profile-form__input"
                                       name="surname" placeholder="Введите фамилию"
                                       value="{{ $profile->surname }}">
                            </div>
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="patronymic">Отчество</label>
                            <input id="patronymic" type="text" class="profile-form__input"
                                   name="patronymic" placeholder="Введите отчество (если есть)"
                                   value="{{ $profile->patronymic }}">
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="email">
                                <i class="bi bi-envelope"></i>
                                Электронная почта
                            </label>
                            <input id="email" type="email" class="profile-form__input"
                                   name="email" placeholder="example@mail.ru"
                                   value="{{ $profile->email }}">
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="phone">
                                <i class="bi bi-telephone"></i>
                                Телефон
                            </label>
                            <input id="phone" type="tel" class="profile-form__input"
                                   name="phone" placeholder="+7 (___) ___-__-__"
                                   value="{{ $profile->phone }}">
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
    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const phone = document.getElementById('phone');
            if (phone) {
                IMask(phone, {
                    mask: '+{7} (000) 000-00-00'
                });
            }
        });
    </script>
@endsection
