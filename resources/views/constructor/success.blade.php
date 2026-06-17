@extends('layout.layout')
@section('content')
    <div class="constructor-page">
        <div class="container">
            <div class="success-block">
                <div class="success-block__icon">✓</div>

                <h1 class="success-block__title">Заказ №{{ $ringOrder->id }} оформлен!</h1>

                <p class="success-block__text">
                    Мы свяжемся с вами по телефону
                    <strong>{{ $ringOrder->phone }}</strong>
                    в ближайшее время для подтверждения и оплаты.
                </p>

                <div class="success-block__details">
                    <div class="checkout-summary__row">
                        <span>Модель</span>
                        <strong>{{ $ringOrder->ringModel->name }} ({{ $ringOrder->ringModel->type }})</strong>
                    </div>
                    <div class="checkout-summary__row">
                        <span>Материал</span>
                        <strong>{{ $ringOrder->material->name }}</strong>
                    </div>
                    <div class="checkout-summary__row">
                        <span>Размер</span>
                        <strong>{{ $ringOrder->ring_size }}</strong>
                    </div>
                    <div class="checkout-summary__row">
                        <span>Статус</span>
                        <strong>{{ $ringOrder->status }}</strong>
                    </div>
                </div>

                <a href="{{ route('constructor.index') }}" class="constructor-submit constructor-submit--link">
                    Вернуться к конструктору
                </a>
            </div>
        </div>
    </div>
@endsection

