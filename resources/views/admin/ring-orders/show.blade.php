@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="constructor-page">
        <div class="container">
            <a href="{{ route('crm.ring-orders.index') }}" class="checkout-back" style="text-align: left; display:inline-block; margin-bottom: 16px;">
                ← К списку заказов
            </a>
            <h1 class="constructor-page__title">Заказ №{{ $ringOrder->id }}</h1>
            <p class="constructor-page__subtitle">
                Создан: {{ $ringOrder->created_at->format('d.m.Y H:i') }}
            </p>

            @if(session('success'))
                <div class="admin-flash admin-flash--success">{{ session('success') }}</div>
            @endif

            <div class="checkout-wrapper">
                <div class="checkout-form">

                    {{-- Клиент --}}
                    <div class="constructor-panel checkout-section">
                        <h3 class="checkout-section__title">Клиент</h3>
                        <div class="checkout-summary__rows" style="margin: 0; padding: 0; background: transparent; border: none;">
                            <div class="checkout-summary__row">
                                <span>ФИО</span>
                                <strong>{{ $ringOrder->surname }} {{ $ringOrder->name }} {{ $ringOrder->patronymic }}</strong>
                            </div>
                            <div class="checkout-summary__row">
                                <span>Телефон</span>
                                <strong>{{ $ringOrder->phone }}</strong>
                            </div>
                            @if($ringOrder->email)
                                <div class="checkout-summary__row">
                                    <span>Email</span>
                                    <strong>{{ $ringOrder->email }}</strong>
                                </div>
                            @endif
                            @if($ringOrder->user)
                                <div class="checkout-summary__row">
                                    <span>Аккаунт</span>
                                    <strong>{{ $ringOrder->user->email ?? 'ID: ' . $ringOrder->user->id }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Адрес --}}
                    <div class="constructor-panel checkout-section">
                        <h3 class="checkout-section__title">Адрес доставки</h3>
                        <div class="checkout-summary__rows" style="margin: 0; padding: 0; background: transparent; border: none;">
                            <div class="checkout-summary__row">
                                <span>Страна</span>
                                <strong>{{ $ringOrder->country }}</strong>
                            </div>
                            <div class="checkout-summary__row">
                                <span>Город</span>
                                <strong>{{ $ringOrder->city }}</strong>
                            </div>
                            <div class="checkout-summary__row">
                                <span>Улица</span>
                                <strong>{{ $ringOrder->street }}, д. {{ $ringOrder->house_number }}</strong>
                            </div>
                            <div class="checkout-summary__row">
                                <span>Индекс</span>
                                <strong>{{ $ringOrder->zip_code }}</strong>
                            </div>
                        </div>
                    </div>

                    {{-- Комментарий --}}
                    @if($ringOrder->comment)
                        <div class="constructor-panel checkout-section">
                            <h3 class="checkout-section__title">Комментарий клиента</h3>
                            <p style="color: rgba(255,255,255,.7); line-height: 1.6; margin: 0;">
                                {{ $ringOrder->comment }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Сводка + смена статуса --}}
                <aside class="constructor-panel checkout-summary">
                    <h3 class="checkout-section__title">Заказ</h3>

                    <div class="checkout-summary__rows">
                        <div class="checkout-summary__row">
                            <span>Модель</span>
                            <strong>{{ $ringOrder->ringModel->name }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Тип</span>
                            <strong>{{ $ringOrder->ringModel->type }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Материал</span>
                            <strong>{{ $ringOrder->material->name }}</strong>
                        </div>
                        <div class="checkout-summary__row">
                            <span>Размер</span>
                            <strong>{{ $ringOrder->ring_size }}</strong>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('crm.ring-orders.update-status', $ringOrder) }}">
                        @csrf
                        @method('PATCH')

                        <div class="constructor-group" style="margin-bottom: 14px;">
                            <label class="constructor-group__label">Статус заказа</label>
                            <div class="size-select-wrap">
                                <select name="status" class="size-select">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $ringOrder->status === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="constructor-submit">Сохранить статус</button>
                    </form>
                </aside>
            </div>
        </div>
    </div>
@endsection
