@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <section class="auth-page">
        <div class="auth-container auth-container--narrow">

            <div class="auth-card">
                <div class="auth-card__header">
                    <i class="bi bi-box-arrow-in-right auth-card__icon"></i>
                    <h1 class="auth-card__title">Вход</h1>
                    <p class="auth-card__subtitle">Войдите в свой аккаунт</p>
                </div>

                @error('identity')
                <div class="auth-alert auth-alert--error">
                    <i class="bi bi-exclamation-circle"></i>
                    <div class="auth-alert__content">
                        <div class="auth-alert__message">{{ $message }}</div>
                        <a href="{{ route('register.index') }}" class="auth-alert__link">Зарегистрироваться</a>
                    </div>
                </div>
                @enderror

                <form method="post" action="{{ route('login.store') }}" class="auth-form">
                    @csrf

                    <div class="auth-form__field">
                        <label for="identity" class="auth-form__label">Логин или Email</label>
                        <input type="text" name="identity" id="identity"
                               class="auth-form__input @error('identity') is-invalid @enderror"
                               value="{{ old('identity') }}" required autofocus>
                    </div>

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
                    </div>

                    <div class="auth-form__field auth-form__field--checkbox">
                        <label class="auth-checkbox">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="auth-checkbox__mark"></span>
                            <span class="auth-checkbox__text">Запомнить меня</span>
                        </label>
                    </div>

                    <button type="submit" class="auth-form__submit">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Войти
                    </button>

                    <div class="auth-form__footer">
                        Нет аккаунта?
                        <a href="{{ route('register.index') }}" class="auth-form__link">Зарегистрироваться</a>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
