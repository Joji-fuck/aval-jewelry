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
            <div class="row">
                {{-- ЛЕВАЯ КОЛОНКА: Список товаров --}}
                <div class="col-lg-7 mb-4">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle border-secondary">
                            <thead>
                            <tr class="text-secondary">
                                <th>Товар</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Итого</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $id => $details)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{-- Проверка на наличие картинки --}}
                                            @if(isset($details['images']))
                                                <img src="{{ asset('storage/' . $details['images']) }}"
                                                     class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('storage/default.gif')}}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <small>{{ $details['name'] }}</small>
                                        </div>
                                    </td>
                                    <td>{{ number_format($details['price'], 0, '.', ' ') }}₽</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td class="fw-bold">{{ number_format($details['price'] * $details['quantity'], 0, '.', ' ') }}₽</td>
                                    <td>
                                        <a href="{{ route('cart.remove', $id) }}" class="text-danger"><i class="bi bi-x-lg"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Общая сумма слева (для наглядности) --}}
                    <div class="d-flex justify-content-end mt-3">
                        <h4>Итого к оплате: <span class="text-success">{{ number_format($total, 0, '.', ' ') }} ₽</span></h4>
                    </div>
                </div>

                {{-- ПРАВАЯ КОЛОНКА: Большая форма --}}
                <div class="col-lg-5">
                    <div class="card bg-dark border-secondary">
                        <div class="card-header border-secondary bg-transparent">
                            <h5 class="mb-0 text-white">Оформление заказа</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <h6 class="text-secondary mb-3">Личные данные</h6>

                                <div class="mb-3">
                                    <input type="text" name="surname" class="form-control bg-dark text-white border-secondary" placeholder="Фамилия *" required value="{{ Auth::user()->surname ?? '' }}">
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" placeholder="Имя *" required value="{{ Auth::user()->name ?? '' }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="patronymic" class="form-control bg-dark text-white border-secondary" placeholder="Отчество" value="{{Auth::user()->patronymic ?? ''}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" placeholder="Телефон *" required value="{{Auth::user()->phone ?? ''}}">
                                </div>

                                <hr class="border-secondary my-4">

                                {{-- Блок 2: Адрес --}}
                                <h6 class="text-secondary mb-3">Адрес доставки</h6>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="text" name="country" class="form-control bg-dark text-white border-secondary" placeholder="Страна *" required value="{{Auth::user()->country ?? 'Россия'}}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="city" class="form-control bg-dark text-white border-secondary" placeholder="Город *" required value="{{Auth::user()->city ?? ''}}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="street" class="form-control bg-dark text-white border-secondary" placeholder="Улица *" required value="{{Auth::user()->street ?? ''}}">
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="text" name="house_number" class="form-control bg-dark text-white border-secondary" placeholder="Дом/Кв *" required value="{{Auth::user()->house_number ?? ''}}">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="zip_code" class="form-control bg-dark text-white border-secondary" placeholder="Индекс *" required value="{{Auth::user()->zip_code ?? ''}}">
                                    </div>
                                </div>

                                {{-- Блок 3: Комментарий --}}
                                <div class="mb-4">
                                    <textarea name="comment" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Комментарий к заказу..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-lg">
                                    Подтвердить заказ на {{ number_format($total, 0, '.', ' ') }} ₽
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <h3 class="text-secondary">Корзина пуста</h3>
                <a href="{{route('catalog.index')}}" class="btn btn-outline-light mt-3">Вернуться в магазин</a>
            </div>
        @endif
    </div>
@endsection
