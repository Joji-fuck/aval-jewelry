@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <section class="auth-page">
        <div class="auth-container">

            <div class="auth-card">
                <div class="auth-card__header">
                    <i class="bi bi-person-plus auth-card__icon"></i>
                    <h1 class="auth-card__title">Регистрация</h1>
                    <p class="auth-card__subtitle">Создайте аккаунт, чтобы оформлять заказы</p>
                </div>

                <form method="post" action="{{ route('register.store') }}" class="auth-form">
                    @csrf

                    <div class="auth-form__row auth-form__row--2">
                        <div class="auth-form__field">
                            <label for="surname" class="auth-form__label">Фамилия</label>
                            <input type="text" name="surname" id="surname"
                                   class="auth-form__input @error('surname') is-invalid @enderror"
                                   value="{{ old('surname') }}" required>
                            @error('surname')
                            <div class="auth-form__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-form__field">
                            <label for="name" class="auth-form__label">Имя</label>
                            <input type="text" name="name" id="name"
                                   class="auth-form__input @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required>
                            @error('name')
                            <div class="auth-form__error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="auth-form__field">
                        <label for="email" class="auth-form__label">Электронная почта</label>
                        <input type="email" name="email" id="email"
                               class="auth-form__input @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        <div class="auth-form__hint">
                            Указывая email, вы <strong>НЕ</strong> даёте согласие на рекламную рассылку
                        </div>
                        @error('email')
                        <div class="auth-form__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-form__field">
                        <label for="login" class="auth-form__label">Логин</label>
                        <input type="text" name="login" id="login"
                               class="auth-form__input @error('login') is-invalid @enderror"
                               value="{{ old('login') }}" required>
                        @error('login')
                        <div class="auth-form__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-form__row auth-form__row--2">
                        <div class="auth-form__field">
                            <label for="password" class="auth-form__label">Пароль</label>
                            <div class="auth-form__input-wrap">
                                <input type="password" name="password" id="password"
                                       class="auth-form__input @error('password') is-invalid @enderror"
                                       required>
                                <button type="button" class="auth-form__toggle" data-toggle-password="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="auth-form__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-form__field">
                            <label for="password_confirmation" class="auth-form__label">Повторите пароль</label>
                            <div class="auth-form__input-wrap">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="auth-form__input" required>
                                <button type="button" class="auth-form__toggle" data-toggle-password="password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="auth-form__submit">
                        <i class="bi bi-check2-circle"></i>
                        Зарегистрироваться
                    </button>

                    <div class="auth-form__footer">
                        Уже есть аккаунт?
                        <a href="{{ route('login.index') }}" class="auth-form__link">Войти</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
