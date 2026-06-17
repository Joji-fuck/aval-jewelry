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
            <h1 class="constructor-page__title">Заказы — Конструктор колец</h1>
            <p class="constructor-page__subtitle">Всего: {{ $orders->total() }}</p>

            @if(session('success'))
                <div class="admin-flash admin-flash--success">{{ session('success') }}</div>
            @endif

            {{-- Фильтры --}}
            <div class="constructor-panel admin-filters">
                <form method="GET" action="{{ route('crm.ring-orders.index') }}" class="admin-filters__form">
                    <div class="size-select-wrap">
                        <input type="text" name="search" class="size-select"
                               placeholder="Поиск по ID, ФИО, телефону, email"
                               value="{{ request('search') }}">
                    </div>

                    <div class="size-select-wrap">
                        <select name="status" class="size-select">
                            <option value="">Все статусы</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="constructor-submit admin-filters__submit">Применить</button>

                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('crm.ring-orders.index') }}" class="checkout-back">Сбросить</a>
                    @endif
                </form>
            </div>

            {{-- Таблица --}}
            <div class="constructor-panel admin-table-wrap">
                @if($orders->count())
                    <table class="admin-table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Клиент</th>
                            <th>Контакты</th>
                            <th>Кольцо</th>
                            <th>Размер</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    {{ $order->surname }} {{ $order->name }}
                                    {{ $order->patronymic }}
                                </td>
                                <td>
                                    <div>{{ $order->phone }}</div>
                                    @if($order->email)
                                        <div class="admin-table__muted">{{ $order->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    {{ $order->ringModel->name }}
                                    <div class="admin-table__muted">
                                        {{ $order->ringModel->type }} · {{ $order->material->name }}
                                    </div>
                                </td>
                                <td>{{ $order->ring_size }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('crm.ring-orders.update-status', $order) }}"
                                          class="admin-status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status"
                                                class="size-select admin-status-select admin-status-select--{{ Str::slug($order->status) }}"
                                                onchange="this.form.submit()">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="admin-table__muted">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    <a href="{{ route('crm.ring-orders.show', $order) }}" class="admin-link">
                                        Открыть →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="admin-pagination">
                        {{ $orders->links() }}
                    </div>
                @else
                    <p class="admin-empty">Заказов пока нет</p>
                @endif
            </div>
        </div>
    </div>
@endsection
