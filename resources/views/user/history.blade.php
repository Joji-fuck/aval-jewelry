@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container" data-bs-theme="dark">
        <h1 class="text-white">Профиль</h1>
        <div class="profile">
            <aside class="profile-left">
                @include('user.layout.aside')
            </aside>
            <div class="profile-right">
                @if($orders->isEmpty())
                    <div class="alert alert-dark border-secondary text-white">
                        У вас пока нет заказов.
                    </div>
                @else
                    <div class="orders-wrapper">
                        @forelse($orders->sortByDesc('id') as $order)
                            @php
                                $statusConfig = match($order->status) {
                                    'Ожидает оплаты' => ['class' => 'status-pending', 'icon' => 'bi-clock-history'],
                                    'Завершен', 'paid' => ['class' => 'status-success', 'icon' => 'bi-check-circle-fill'],
                                    'Отменен' => ['class' => 'status-cancelled', 'icon' => 'bi-x-circle-fill'],
                                    default => ['class' => 'status-default', 'icon' => 'bi-info-circle'],
                                };
                            @endphp

                            <div class="order-card">
                                {{-- Шапка --}}
                                <div class="order-card__header">
                                    <div class="order-card__id">
                                        <span class="order-card__label">Заказ</span>
                                        <span class="order-card__number" style="color: rgba(49, 210, 242, 0.8);">№{{ $order->id }}</span>
                                    </div>

                                    <div class="order-card__status {{ $statusConfig['class'] }}">
                                        <i class="bi {{ $statusConfig['icon'] }}"></i>
                                        <span>{{ $order->status }}</span>
                                    </div>
                                </div>

                                {{-- Дата --}}
                                <div class="order-card__date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $order->created_at->format('d.m.Y') }} в {{ $order->created_at->format('H:i') }}
                                </div>

                                {{-- Превью товаров --}}
                                <div class="order-card__preview">
                                    @foreach($order->products->take(3) as $product)
                                        <div class="order-card__product">
                                            <span class="order-card__product-name">{{ $product->name }}</span>
                                            <span class="order-card__product-qty">×{{ $product->pivot->quantity }}</span>
                                        </div>
                                    @endforeach

                                    @if($order->products->count() > 3)
                                        <div class="order-card__more">
                                            и ещё {{ $order->products->count() - 3 }} {{ \Illuminate\Support\Str::plural('позиция', $order->products->count() - 3) }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Подвал --}}
                                <div class="order-card__footer">
                                    <div class="order-card__total">
                                        <span class="order-card__total-label">Итого</span>
                                        <span class="order-card__total-value">
                        {{ number_format($order->total_price, 0, ',', ' ') }} ₽
                    </span>
                                    </div>

                                    <button class="order-card__toggle" type="button" data-order-toggle="{{ $order->id }}">
                                        <span class="order-card__toggle-text">Детали</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                </div>

                                {{-- Раскрываемый список --}}
                                <div class="order-card__details" data-order-details="{{ $order->id }}">
                                    <div class="order-card__details-inner">
                                        <div class="order-card__details-title">Состав заказа</div>
                                        <ul class="order-card__details-list">
                                            @foreach($order->products as $product)
                                                <li class="order-card__details-item">
                                                    <span class="order-card__details-name">{{ $product->name }}</span>
                                                    <span class="order-card__details-meta">
                                    {{ $product->pivot->quantity }} шт. ×
                                    {{ number_format($product->price ?? 0, 0, ',', ' ') }} ₽
                                </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="orders-empty">
                                <i class="bi bi-bag-x"></i>
                                <p>У вас пока нет заказов</p>
                                <a href="{{ route('catalog.index') }}" class="orders-empty__link">Перейти в каталог</a>
                            </div>
                        @endforelse
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
