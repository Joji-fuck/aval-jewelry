@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-white">Заявки (Заказы)</h2>

        <table class="table table-dark table-hover mt-3">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Дата</th>
                <th>Клиент</th>
                <th>Телефон</th>
                <th>Товары</th>
                <th>Сумма</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <strong>{{ $order->name }}</strong><br>
                        <small class="text-muted">{{ $order->email }}</small>
                    </td>
                    <td>{{ $order->phone }}</td>

                    {{-- Список товаров в ячейке --}}
                    <td>
                        <ul style="padding-left: 20px; margin: 0;">
                            @foreach($order->products as $product)
                                <li>
                                    {{ $product->name }}
                                    ({{ $product->stock }} шт. x {{ $product->price }} ₽)
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <td>
                        <strong>{{ number_format($order->total_price, 0, ',', ' ') }} ₽</strong>
                    </td>

                    <td>
                        <form action="{{ route('crm.order.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()"
                                    class="form-control form-control-sm
                                @if($order->status == 'Ожидает оплаты') bg-warning
                                @elseif($order->status == 'Завершен') bg-success text-white
                                @elseif($order->status == 'Отменен') bg-danger text-white
                                @endif">
                                <option value="Ожидает оплаты" {{ $order->status == 'Ожидает оплаты' ? 'selected' : '' }}>Ожидает оплаты</option>
                                <option value="Оплачен" {{ $order->status == 'Оплачен' ? 'selected' : '' }}>Оплачен</option>
                                <option value="В работе" {{ $order->status == 'В работе' ? 'selected' : '' }}>В работе</option>
                                <option value="Завершен" {{ $order->status == 'Завершен' ? 'selected' : '' }}>Завершен</option>
                                <option value="Отменен" {{ $order->status == 'Отменен' ? 'selected' : '' }}>Отменен</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Пагинация --}}
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
