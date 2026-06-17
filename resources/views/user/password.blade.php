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

                <form class="profile-right profile-card" action="{{ route('profile.password.update') }}" method="post">
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

                    @if ($errors->any())
                        <div class="profile-alert profile-alert--error">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            <div class="profile-alert__content">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="profile-card__header">
                        <h2 class="profile-card__title">Смена пароля</h2>
                        <p class="profile-card__subtitle">Регулярно обновляйте пароль для безопасности аккаунта</p>
                    </div>

                    <div class="profile-form">

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="old_password">
                                <i class="bi bi-shield-lock"></i>
                                Текущий пароль
                            </label>
                            <div class="profile-form__input-wrap">
                                <input id="old_password" type="password" autofocus
                                       class="profile-form__input @error('old_password') is-invalid @enderror"
                                       name="old_password" placeholder="Введите текущий пароль" required>
                                <button type="button" class="profile-form__toggle" data-toggle-password="old_password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('old_password')
                            <div class="profile-form__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="password">
                                <i class="bi bi-key"></i>
                                Новый пароль
                            </label>
                            <div class="profile-form__input-wrap">
                                <input id="password" type="password"
                                       class="profile-form__input @error('password') is-invalid @enderror"
                                       name="password" placeholder="Минимум 8 символов" required>
                                <button type="button" class="profile-form__toggle" data-toggle-password="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="profile-form__hint">
                                Используйте буквы, цифры и специальные символы
                            </div>
                            @error('password')
                            <div class="profile-form__error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="profile-form__group">
                            <label class="profile-form__label" for="password_confirmation">
                                <i class="bi bi-check2-square"></i>
                                Подтверждение пароля
                            </label>
                            <div class="profile-form__input-wrap">
                                <input id="password_confirmation" type="password"
                                       class="profile-form__input"
                                       name="password_confirmation" placeholder="Повторите новый пароль" required>
                                <button type="button" class="profile-form__toggle" data-toggle-password="password_confirmation">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="profile-card__footer">
                        <button class="profile-button profile-button--primary" type="submit">
                            <i class="bi bi-shield-check"></i>
                            Сменить пароль
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        btn.addEventListener('click', () => {
                const id = btn.dataset.togglePassword;
                const input = document.getElementById(id);
                const icon = btn.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
    </script>
@endsection
