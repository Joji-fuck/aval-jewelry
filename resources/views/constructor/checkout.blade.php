@extends('layout.layout')
@section('content')
    <div class="constructor-page">
        <div class="container">
            <h1 class="constructor-page__title">Оформление заказа</h1>
            <p class="constructor-page__subtitle">Заполните данные для доставки</p>

            <div class="checkout-wrapper">
                {{-- ЛЕВАЯ ЧАСТЬ — ПОЛЯ --}}
                <div class="checkout-form">

                    {{-- Контактные данные --}}
                    <div class="constructor-panel checkout-section">
                        <h3 class="checkout-section__title">Контактные данные</h3>

                        <div class="checkout-row checkout-row--3">
                            <div class="constructor-group">
                                <label class="constructor-group__label">Фамилия *</label>
                                <input type="text" data-field="surname" class="size-select"
                                       value="{{ auth()->user()?->surname }}">
                                <span class="checkout-error" data-error="surname"></span>
                            </div>
                            <div class="constructor-group">
                                <label class="constructor-group__label">Имя *</label>
                                <input type="text" data-field="name" class="size-select"
                                       value="{{ auth()->user()?->name }}">
                                <span class="checkout-error" data-error="name"></span>
                            </div>
                            <div class="constructor-group">
                                <label class="constructor-group__label">Отчество</label>
                                <input type="text" data-field="patronymic" class="size-select">
                                <span class="checkout-error" data-error="patronymic"></span>
                            </div>
                        </div>

                        <div class="checkout-row checkout-row--2">
                            <div class="constructor-group">
                                <label class="constructor-group__label">Телефон *</label>
                                <input type="tel" data-field="phone" class="size-select"
                                       placeholder="+7 (___) ___-__-__">
                                <span class="checkout-error" data-error="phone"></span>
                            </div>
                            <div class="constructor-group">
                                <label class="constructor-group__label">Email</label>
                                <input type="email" data-field="email" class="size-select"
                                       value="{{ auth()->user()?->email }}">
                                <span class="checkout-error" data-error="email"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Адрес --}}
                    <div class="constructor-panel checkout-section">
                        <h3 class="checkout-section__title">Адрес доставки</h3>

                        <div class="checkout-row checkout-row--2">
                            <div class="constructor-group">
                                <label class="constructor-group__label">Страна *</label>
                                <input type="text" data-field="country" class="size-select" value="Россия">
                                <span class="checkout-error" data-error="country"></span>
                            </div>
                            <div class="constructor-group">
                                <label class="constructor-group__label">Город *</label>
                                <input type="text" data-field="city" class="size-select">
                                <span class="checkout-error" data-error="city"></span>
                            </div>
                        </div>

                        <div class="checkout-row checkout-row--street">
                            <div class="constructor-group">
                                <label class="constructor-group__label">Улица *</label>
                                <input type="text" data-field="street" class="size-select">
                                <span class="checkout-error" data-error="street"></span>
                            </div>
                            <div class="constructor-group">
                                <label class="constructor-group__label">Дом *</label>
                                <input type="text" data-field="house_number" class="size-select">
                                <span class="checkout-error" data-error="house_number"></span>
                            </div>
                        </div>

                        <div class="constructor-group">
                            <label class="constructor-group__label">Индекс *</label>
                            <input type="text" data-field="zip_code" class="size-select">
                            <span class="checkout-error" data-error="zip_code"></span>
                        </div>
                    </div>

                    {{-- Комментарий --}}
                    <div class="constructor-panel checkout-section">
                        <h3 class="checkout-section__title">Комментарий к заказу</h3>
                        <div class="constructor-group">
                        <textarea data-field="comment" class="size-select size-select--textarea"
                                  rows="4" placeholder="Пожелания, гравировка и т.д."></textarea>
                            <span class="checkout-error" data-error="comment"></span>
                        </div>
                    </div>
                </div>

                {{-- ПРАВАЯ ЧАСТЬ — СВОДКА --}}
                <aside class="constructor-panel checkout-summary">
                    <h3 class="checkout-section__title">Ваш заказ</h3>

                    @if($ringModel->thumbnail)
                        <img src="{{ asset('storage/' . $ringModel->thumbnail) }}"
                             alt="{{ $ringModel->name }}"
                             class="checkout-summary__image">
                    @endif

                    <div class="checkout-summary__rows">
                        <div class="checkout-summary__row">
                            <span>Модель</span>
                            <strong>{{ $ringModel->name }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Тип</span>
                            <strong>{{ $ringModel->type }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Материал</span>
                            <strong>{{ $material->name }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Размер</span>
                            <strong>{{ $ringSize }}</strong>
                        </div>
                    </div>

                    <div id="form-general-error" class="checkout-error checkout-error--general"></div>

                    <button type="button" id="submit-order" class="constructor-submit">
                        Подтвердить заказ
                    </button>

                    <a href="{{ route('constructor.index') }}" class="checkout-back">← Вернуться к конструктору</a>
                </aside>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const submitBtn  = document.getElementById('submit-order');
            const generalErr = document.getElementById('form-general-error');

            // Скрытые "хардкод" значения с прошлой страницы
            const fixedData = {
                ring_model_id: {{ $ringModel->id }},
                material_id:   {{ $material->id }},
                ring_size:     {{ $ringSize }},
            };

            function clearErrors() {
                document.querySelectorAll('.checkout-error').forEach(el => el.textContent = '');
                document.querySelectorAll('[data-field]').forEach(el => el.classList.remove('is-invalid'));
                generalErr.textContent = '';
            }

            function showErrors(errors) {
                for (const field in errors) {
                    const errorEl = document.querySelector(`[data-error="${field}"]`);
                    const inputEl = document.querySelector(`[data-field="${field}"]`);

                    if (errorEl) errorEl.textContent = errors[field][0];
                    if (inputEl) inputEl.classList.add('is-invalid');
                }
            }

            function collectData() {
                const data = { ...fixedData };
                document.querySelectorAll('[data-field]').forEach(el => {
                    data[el.dataset.field] = el.value.trim();
                });
                return data;
            }

            submitBtn.addEventListener('click', async () => {
                clearErrors();
                submitBtn.disabled = true;
                submitBtn.textContent = 'Отправка...';

                try {
                    const response = await fetch('{{ route("ring-orders.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify(collectData()),
                    });

                    const data = await response.json();

                    if (response.status === 422) {
                        showErrors(data.errors);
                        generalErr.textContent = 'Проверьте правильность заполнения полей';
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('Ошибка сервера');
                    }

                    // Успех — редирект
                    window.location.href = data.redirect_url;

                } catch (err) {
                    console.error(err);
                    generalErr.textContent = 'Что-то пошло не так. Попробуйте позже.';
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Подтвердить заказ';
                }
            });
        })();
    </script>
@endsection
