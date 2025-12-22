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
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                        @foreach($orders as $order)
                            <div class="col">
                                {{-- Карточка: Темный фон, серая рамка --}}
                                <div class="card h-100 bg-dark text-white border-secondary shadow-lg">
                                    <div class="card-body p-3">

                                        {{-- Шапка: Номер и Статус --}}
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="card-title fw-bold mb-0 text-white">Заказ №{{ $order->id }}</h6>

                                            @php
                                                // Яркие бейджи для контраста
                                                $badgeClass = match($order->status) {
                                                    'new' => 'bg-warning text-dark', // Желтый
                                                    'processing' => 'bg-info text-dark', // Голубой
                                                    'completed', 'paid' => 'bg-success text-white', // Зеленый
                                                    'cancelled' => 'bg-danger text-white', // Красный
                                                    default => 'bg-secondary text-white',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} rounded-pill border border-dark">
                                        {{ $order->status }}
                                    </span>
                                        </div>

                                        {{-- Дата (text-white-50 для читаемости на черном) --}}
                                        <div class="text-white-50 small mb-3">
                                            {{ $order->created_at->format('d.m.Y в H:i') }}
                                        </div>

                                        {{-- Краткий список: полупрозрачный фон вместо белого --}}
                                        <div class="rounded p-2 mb-3" style="background-color: rgba(255,255,255, 0.08);">
                                            <ul class="list-unstyled mb-0 small text-light">
                                                @foreach($order->products->take(2) as $product)
                                                    <li class="d-flex justify-content-between">
                                                        <span class="text-truncate" style="max-width: 150px;">{{ $product->name }}</span>
                                                        <span class="text-white-50">x{{ $product->pivot->quantity }}</span>
                                                    </li>
                                                @endforeach

                                                @if($order->products->count() > 2)
                                                    <li class="text-white-50 fst-italic mt-1">
                                                        + еще {{ $order->products->count() - 2 }} поз.
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        {{-- Подвал карточки: Цена и Кнопка --}}
                                        <div class="d-flex justify-content-between align-items-center mt-auto border-top border-secondary pt-3">
                                            <div class="fw-bold fs-5 text-white">
                                                {{ number_format($order->total_price, 0, ',', ' ') }} ₽
                                            </div>
                                            <button class="btn btn-sm btn-outline-light"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#uniqueOrder{{ $order->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="uniqueOrder{{ $order->id }}">
                                                Детали
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Выпадающий список (Детали) --}}
                                    <div class="collapse" id="uniqueOrder{{ $order->id }}">
                                        <div class="card-footer bg-dark border-top border-secondary p-3">
                                            <small class="fw-bold text-white-50">Полный состав:</small>
                                            <ul class="list-group list-group-flush mt-2">
                                                @foreach($order->products as $product)
                                                    <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2 d-flex justify-content-between">
                                                        <span>{{ $product->name }}</span>
                                                        <span class="badge bg-secondary">{{ $product->pivot->quantity }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
