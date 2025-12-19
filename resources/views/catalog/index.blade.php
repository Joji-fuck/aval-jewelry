@extends('layout.layout')
@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <style>
        .form-control-dark::placeholder {
            color: #6c757d; /* Светло-серый (Bootstrap secondary) */
            opacity: 1; /* Важно для Firefox, иначе он делает цвет полупрозрачным */
        }
    /* Стили карточки товара */
    .product-card {
        background-color: #1a1a1a;
        border: 1px solid #333;
        transition: transform 0.2s, border-color 0.2s;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-5px);
        border-color: #d4af37; /* Золотая обводка при наведении */
    }

    /* Сайдбар */
    .filter-sidebar {
        background-color: #161616;
        border-right: 1px solid #333;
        padding: 20px;
        border-radius: 8px;
    }

    /* Элементы форм */
    .form-control-dark, .form-select-dark {
        background-color: #2b2b2b;
        border: 1px solid #444;
        color: #fff;
    }
    .form-control-dark:focus, .form-select-dark:focus {
        background-color: #333;
        border-color: #d4af37;
        color: #fff;
        box-shadow: none;
    }

    .text-gold { color: #d4af37; }
    .btn-gold {
        background-color: #d4af37;
        color: #000;
        font-weight: bold;
        border: none;
    }
    .btn-gold:hover { background-color: #b5952f; color: #000; }

    /* Цена */
    .price-tag { font-size: 1.2rem; font-weight: bold; color: #fff; }
</style>
    <div class="container-fluid py-5">
        <div class="row">

            {{-- === САЙДБАР С ФИЛЬТРАМИ (3 колонки) === --}}
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar sticky-top" style="top: 20px; z-index: 1;">
                    <h4 class="mb-4 text-white"><i class="bi bi-sliders"></i> Фильтры</h4>

                    <form action="{{ route('catalog.index') }}" method="GET" id="filterForm">

                        {{-- 1. Тип изделия --}}
                        <div class="mb-4">
                            <label class="form-label text-gold text-uppercase fw-bold small">Тип изделия</label>
                            <select name="type" class="form-select form-select-dark" onchange="this.form.submit()">
                                <option value="">Все товары</option>
                                <option value="stone" {{ request('type') == 'stone' ? 'selected' : '' }}>Драгоценные камни</option>
                                <option value="jewelry" {{ request('type') == 'jewelry' ? 'selected' : '' }}> Украшения</option>
                            </select>
                        </div>

                        {{-- 2. Цена --}}
                        <div class="mb-4">
                            <label class="form-label text-gold text-uppercase fw-bold small">Цена ($)</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="price_min" class="form-control form-control-dark" placeholder="От" value="{{ request('price_min') }}">
                                <input type="number" name="price_max" class="form-control form-control-dark" placeholder="До" value="{{ request('price_max') }}">
                            </div>
                        </div>

                        {{-- 3. Категория (Общая) --}}
                        <div class="mb-4">
                            <label class="form-label text-gold text-uppercase fw-bold small">Категория</label>
                            @foreach($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input bg-dark border-secondary" type="radio" name="category_id" value="{{ $cat->id }}" id="cat_{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'checked' : '' }}>
                                    <label class="form-check-label text-secondary" for="cat_{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- ДИНАМИЧЕСКИЕ ФИЛЬТРЫ (JS не нужен, используем Blade условия) --}}

                        {{-- Только для УКРАШЕНИЙ --}}
                        @if(request('type') == 'jewelry')
                            <div class="mb-4 p-3 rounded border border-secondary" style="background: rgba(255, 193, 7, 0.05);">
                                <label class="form-label text-warning fw-bold small">Материал</label>
                                <select name="material_id" class="form-select form-select-dark form-select-sm">
                                    <option value="">Любой</option>
                                    @foreach($materials as $mat)
                                        <option value="{{ $mat->id }}" {{ request('material_id') == $mat->id ? 'selected' : '' }}>
                                            {{ $mat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        {{-- Только для КАМНЕЙ --}}
                        @if(request('type') == 'stone')
                            <div class="mb-4 p-3 rounded border border-secondary" style="background: rgba(13, 202, 240, 0.05);">
                                <label class="form-label text-info fw-bold small">Мин. вес (ct)</label>
                                <input type="number" step="0.01" name="stone_weight_min" class="form-control form-control-dark form-control-sm" value="{{ request('stone_weight_min') }}">
                            </div>
                        @endif

                        {{-- Кнопки --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gold">Применить</button>
                            <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary btn-sm">Сбросить</a>
                        </div>

                    </form>
                </div>
            </div>

            {{-- === СЕТКА ТОВАРОВ (9 колонок) === --}}
            <div class="col-lg-9">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-white">Каталог</h2>
                    <span class="text-white">Найдено: {{ $products->total() }} шт.</span>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    @forelse($products as $product)
                        <div class="col">
                            <div class="card product-card h-100">
                                <div style="height: 250px; overflow: hidden;" class="position-relative">
                                    @if($product->images->isNotEmpty())
                                        <a href="{{route('catalog.show', $product->slug)}}" class="w-60">
                                            <img src="{{ asset('storage/' . $product->images->first()->path) }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $product->name }}">
                                        </a>
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-secondary bg-opacity-10">
                                            <a href="{{route('catalog.show', $product->slug)}}" class="w-60">
                                                <img src="{{ asset('storage/default.gif') }}" style="max-height: 50%; opacity: 0.5;">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="position-absolute top-0 end-0 m-2">
                                        @if($product->productable_type === 'App\Models\Stone')
                                            <span class="badge bg-info text-dark">Камень</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Изделие</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-white text-truncate">{{ $product->name }}</h5>
                                    <p class="small text-gray-500 mb-2">{{ $product->sku }}</p>

                                    {{-- Характеристики (Полиморфные) --}}
                                    <div class="mb-3 small text-secondary">
                                        @if($product->productable_type === 'App\Models\Stone')
                                            Вес: <span class="text-white">{{ $product->productable->weight }} ct</span>
                                        @elseif($product->productable_type === 'App\Models\JewelryItem')
                                            Размер: <span class="text-white">{{ $product->productable->size }}</span>
                                        @endif
                                    </div>

                                    <div class="mt-auto d-flex justify-content-between align-items-center w-48">
                                        <div class="price-tag">{{ number_format($product->price, 0, '.', ' ') }}₽</div>
                                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">
                                            В корзину
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h4 class="text-white">Товары не найдены</h4>
                            <p class="text-secondary">Попробуйте изменить параметры фильтрации</p>
                        </div>
                    @endforelse
                </div>

                {{-- Пагинация --}}
                <div class="mt-5">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
@endsection
