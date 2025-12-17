@extends('layout.layout')
@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')


    <div class="container py-5 text-white">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-pretty text-decoration-none">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('catalog.index')}}" class="text-pretty text-decoration-none">Каталог</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">
                    <a>
                    {{ $product->name }}
                    </a>
                </li>
            </ol>
        </nav>

        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card bg-secondary border-0">
                    @if($product->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                             class="rounded border border-secondary"
                             style="width: 560px; height: 560px; object-fit: cover;"
                             id="mainImage"
                             alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('storage/default.gif')}}"
                             class="rounded border border-secondary"
                             style="width: 560px; height: 560px; object-fit: cover;"
                             alt="Нет фото">
                    @endif
                </div>
                <div class="row mt-2">
                        @if($product->images->count() > 0)
                            <div class="row g-2">
                                @foreach($product->images as $image)
                                    <div class="col-3">
                                        {{-- Карточка миниатюры --}}
                                        <img
                                            src="{{ asset('storage/' . $image->path) }}"
                                            class="img-fluid rounded border border-secondary thumbnail-img"
                                            style="cursor: pointer; object-fit: cover; height: 80px; width: 100%;"
                                            onclick="document.getElementById('mainImage').src = this.src"
                                            alt="Фото {{ $product->title }}"
                                        >
                                    </div>
                                @endforeach
                                @else
                                        <div class="row g-2">
                                                <div class="col-3">
                                                    {{-- Карточка миниатюры --}}
                                                    <img
                                                        src="{{ asset('storage/default.gif') }}"
                                                        class="img-fluid rounded border border-secondary thumbnail-img"
                                                        style="cursor: pointer; object-fit: cover; height: 80px; width: 100%;"
                                                        onclick="document.getElementById('mainImage').src = this.src"
                                                        alt="Фото {{ $product->title }}"
                                                    >
                                                </div>
                                    @endif
                </div>
            </div>
            </div>
            <div class="col-md-6 mb-3">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold">
                    {{ $product->name }}
                </h1>

                <div class="mb-3">
                    <span class="badge bg-warning text-dark me-2">Хит продаж</span>
                    <span class="text-secondary">Артикул: {{ $product->sku ?? '0000' }}</span>
                </div>

                <div class="fs-4 mb-4">
                    <span class="fw-bold text-success">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                </div>

                <p class="lead text-secondary">
                    {{ $product->description ?? 'Краткое описание товара, основные преимущества и особенности.' }}
                </p>

                {{-- Блок добавления в корзину --}}
{{--                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center mb-4">--}}
{{--                    @csrf--}}
{{--                    <div class="me-3" style="width: 80px;">--}}
{{--                        <input type="number" name="quantity" class="form-control form-control-dark bg-dark text-white border-secondary" value="1" min="1">--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-primary btn-lg px-4">--}}
{{--                        <i class="bi bi-cart-plus"></i> В корзину--}}
{{--                    </button>--}}
{{--                </form>--}}

{{--                <div class="card bg-dark border-secondary mb-3">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title text-white">Коротко о товаре</h5>--}}
{{--                        <ul class="list-unstyled text-secondary mb-0">--}}
{{--                            --}}{{-- Пример списка характеристик --}}
{{--                            <li><i class="bi bi-check-lg text-success me-2"></i>Бренд: {{ $product->brand_name }}</li>--}}
{{--                            <li><i class="bi bi-check-lg text-success me-2"></i>Цвет: {{ $product->color }}</li>--}}
{{--                            <li><i class="bi bi-check-lg text-success me-2"></i>Гарантия: 1 год</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

        {{-- НИЖНИЙ БЛОК: Табы с подробностями --}}
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs border-secondary" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active bg-dark text-white border-secondary border-bottom-0" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button">Описание</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-dark text-secondary border-secondary border-bottom-0" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button">Характеристики</button>
                    </li>
                </ul>

                <div class="tab-content p-4 border border-top-0 border-secondary rounded-bottom bg-dark" id="productTabContent">
                    {{-- ТАБ 1: Полное описание --}}
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">
                        <div class="text-secondary">
                            {!! $product->description !!}
                        </div>
                    </div>

                    {{-- ТАБ 2: Таблица характеристик --}}
                    <div class="tab-pane fade" id="specs" role="tabpanel">
                        <table class="table table-dark table-striped table-hover">
                            <tbody>
                            {{-- Здесь можно пустить цикл по характеристикам --}}
                            <tr>
                                <th scope="row" class="w-25 text-secondary">Вес</th>
                                <td>{{ $product->weight }} кг</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Материал</th>
                                <td>{{ $product->material }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Страна</th>
                                <td>{{ $product->country }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
