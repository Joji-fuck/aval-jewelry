@extends('layout.layout')
@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <style>
        input.form-control.bg-dark.text-white.border-secondary::placeholder{
            color: rgba(255, 255, 255, 0.3);
        }
    </style>
    <div class="container py-5 text-white">
        <h1 class="mb-4">Корзина</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="cart-page">
                <div class="cart-grid">

                    {{-- ===== ЛЕВАЯ КОЛОНКА: Список товаров ===== --}}
                    <div class="cart-items">
                        <h2 class="cart-section__title">Ваша корзина</h2>

                        <div class="cart-list">
                        @foreach($cart as $id => $details)
                                <div class="cart-item">
                                    <div class="cart-item__image">
                                        @if(isset($details['image']))
                                            <img src="{{ asset('storage/' . $details['image']) }}"
                                                 alt="{{ $details['name'] }}">
                                        @else
                                            <img src="{{ asset('storage/default.gif') }}"
                                                 alt="Нет фото">
                                        @endif
                                    </div>

                                    <div class="cart-item__info">
                                        <div class="cart-item__name">{{ $details['name'] }}</div>
                                        <div class="cart-item__price">
                                            {{ number_format($details['price'], 0, '.', ' ') }} ₽
                                            <span class="cart-item__qty">× {{ $details['quantity'] }} шт.</span>
                                        </div>
                                    </div>

                                    <div class="cart-item__total">
                                        {{ number_format($details['price'] * $details['quantity'], 0, '.', ' ') }} ₽
                                    </div>

                                    <a href="{{ route('cart.remove', $id) }}" class="cart-item__remove" title="Удалить">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="cart-summary">
                            <span class="cart-summary__label">Итого к оплате</span>
                            <span class="cart-summary__value">
                        {{ number_format($total, 0, '.', ' ') }} ₽
                    </span>
                        </div>
                    </div>

                    {{-- ===== ПРАВАЯ КОЛОНКА: Форма оформления ===== --}}
                    <div class="cart-form">
                        <div class="cart-form__header">
                            <h3 class="cart-form__title">Оформление заказа</h3>
                        </div>

                        <form action="{{ route('order.store') }}" method="POST" class="cart-form__body">
                            @csrf

                            {{-- Личные данные --}}
                            <div class="cart-form__section">
                                <div class="cart-form__section-title">Личные данные</div>

                                <div class="cart-form__field">
                                    <input type="text" name="surname" class="cart-form__input"
                                           placeholder="Фамилия *" required
                                           value="{{ Auth::user()->surname ?? '' }}">
                                </div>

                                <div class="cart-form__row cart-form__row--2">
                                    <div class="cart-form__field">
                                        <input type="text" name="name" class="cart-form__input"
                                               placeholder="Имя *" required
                                               value="{{ Auth::user()->name ?? '' }}">
                                    </div>
                                    <div class="cart-form__field">
                                        <input type="text" name="patronymic" class="cart-form__input"
                                               placeholder="Отчество"
                                               value="{{ Auth::user()->patronymic ?? '' }}">
                                    </div>
                                </div>

                                <div class="cart-form__field">
                                    <input type="tel" name="phone" class="cart-form__input"
                                           placeholder="Телефон *" required
                                           value="{{ Auth::user()->phone ?? '' }}">
                                </div>
                            </div>

                            {{-- Адрес --}}
                            <div class="cart-form__section">
                                <div class="cart-form__section-title">Адрес доставки</div>

                                <div class="cart-form__row cart-form__row--2">
                                    <div class="cart-form__field">
                                        <input type="text" name="country" class="cart-form__input"
                                               placeholder="Страна *" required
                                               value="{{ Auth::user()->country ?? 'Россия' }}">
                                    </div>
                                    <div class="cart-form__field">
                                        <input type="text" name="city" class="cart-form__input"
                                               placeholder="Город *" required
                                               value="{{ Auth::user()->city ?? '' }}">
                                    </div>
                                </div>

                                <div class="cart-form__field">
                                    <input type="text" name="street" class="cart-form__input"
                                           placeholder="Улица *" required
                                           value="{{ Auth::user()->street ?? '' }}">
                                </div>

                                <div class="cart-form__row cart-form__row--2">
                                    <div class="cart-form__field">
                                        <input type="text" name="house_number" class="cart-form__input"
                                               placeholder="Дом/Кв *" required
                                               value="{{ Auth::user()->house_number ?? '' }}">
                                    </div>
                                    <div class="cart-form__field">
                                        <input type="text" name="zip_code" class="cart-form__input"
                                               placeholder="Индекс *" required
                                               value="{{ Auth::user()->zip_code ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Комментарий --}}
                            <div class="cart-form__section">
                                <div class="cart-form__section-title">Комментарий</div>
                                <div class="cart-form__field">
                            <textarea name="comment" class="cart-form__input cart-form__input--textarea"
                                      rows="3" placeholder="Комментарий к заказу..."></textarea>
                                </div>
                            </div>

                            <button type="submit" class="cart-form__submit">
                                <i class="bi bi-check-circle"></i>
                                Подтвердить заказ на {{ number_format($total, 0, '.', ' ') }} ₽
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @else
            <div class="cart-empty">
                <i class="bi bi-bag-x"></i>
                <h3>Ваша корзина пуста</h3>
                <p>Добавьте товары из каталога, чтобы оформить заказ</p>
                <a href="{{ route('catalog.index') }}" class="cart-empty__link">Перейти в каталог</a>
            </div>
        @endif
    </div>
@endsection
