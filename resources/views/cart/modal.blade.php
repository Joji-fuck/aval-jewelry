<div class="modal fade cart-modal" id="exampleModal" tabindex="-1"
     aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content cart-modal__content">

            {{-- Шапка --}}
            <div class="cart-modal__header">
                <div class="cart-modal__title-wrap">
                    <i class="bi bi-bag-heart"></i>
                    <h2 class="cart-modal__title" id="cartModalLabel">Корзина</h2>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="cart-modal__counter">{{ count(session('cart')) }}</span>
                    @endif
                </div>
                <button type="button" class="cart-modal__close" data-bs-dismiss="modal" aria-label="Закрыть">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            {{-- Тело --}}
            <div class="cart-modal__body">
                @if(session('cart') && count(session('cart')) > 0)
                    @php
                        $sessionCart = session('cart', []);
                        $sessionTotal = 0;
                        foreach($sessionCart as $item) {
                            $sessionTotal += $item['price'] * $item['quantity'];
                        }
                        $cart = session()->get('cart', []);
                    @endphp

                    <div class="cart-modal__list">

                        @foreach($cart as $id => $details)
                            <div class="cart-modal__item">
                                <div class="cart-modal__item-image">
                                    @if(isset($details['image']))
                                        <img src="{{ asset('storage/' . $details['image']) }}"
                                             alt="{{ $details['name'] }}">
                                    @else
                                        <img src="{{ asset('storage/default.gif') }}" alt="Нет фото">
                                    @endif
                                </div>

                                <div class="cart-modal__item-info">
                                    <div class="cart-modal__item-name">{{ $details['name'] }}</div>
                                    <div class="cart-modal__item-meta">
                                        {{ $details['quantity'] }} × {{ number_format($details['price'], 0, '.', ' ') }} ₽
                                    </div>
                                </div>

                                <div class="cart-modal__item-total">
                                    {{ number_format($details['price'] * $details['quantity'], 0, '.', ' ') }} ₽
                                </div>

                                <a href="{{ route('cart.remove', $id) }}"
                                   class="cart-modal__item-remove" title="Удалить">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="cart-modal__empty">
                        <i class="bi bi-bag-x"></i>
                        <h4>Корзина пуста</h4>
                        <p>Добавьте товары из каталога</p>
                        <a href="{{ route('catalog.index') }}" class="cart-modal__empty-link">
                            Перейти в каталог
                        </a>
                    </div>
                @endif
            </div>

            {{-- Подвал --}}
            @if(session('cart') && count(session('cart')) > 0)
                <div class="cart-modal__footer">
                    <div class="cart-modal__total">
                        <span class="cart-modal__total-label">Итого</span>
                        <span class="cart-modal__total-value">
                            {{ number_format($sessionTotal, 0, '.', ' ') }} ₽
                        </span>
                    </div>

                    <div class="cart-modal__actions">
                        <button type="button" class="cart-modal__btn cart-modal__btn--ghost"
                                data-bs-dismiss="modal">
                            Закрыть
                        </button>
                        <a href="{{ route('cart.index') }}" class="cart-modal__btn cart-modal__btn--primary">
                            <i class="bi bi-arrow-right"></i>
                            Оформить
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
