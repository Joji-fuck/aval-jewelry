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
        border-color: rgb(13,202,240); /* Золотая обводка при наведении */
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
        border-color: rgb(13,202,240);
        color: #fff;
        box-shadow: none;
    }

    .text-gold { color: rgb(13,202,240); }
    .btn-gold {
        background-color: rgb(13,202,240);
        color: #000;
        font-weight: bold;
        border: none;
    }
    .btn-gold:hover { background-color: rgb(13,202,240); color: #000; }

    /* Цена */
    .price-tag { font-size: 1.2rem; font-weight: bold; color: #fff; }
</style>
    <div class="container-fluid py-5">

        {{--Модальное окно--}}
        @include('cart.modal')
        <div class="row">

            {{-- === САЙДБАР С ФИЛЬТРАМИ (3 колонки) === --}}
            <div class="col-lg-3 mb-4">
                <aside class="filter-sidebar">
                    <div class="filter-sidebar__sticky">

                        <div class="filter-sidebar__header">
                            <i class="bi bi-sliders"></i>
                            <h3 class="filter-sidebar__title">Фильтры</h3>
                        </div>

                        <form action="{{ route('catalog.index') }}" method="GET" id="filterForm" class="filter-form">

                            {{-- 1. Тип изделия --}}
                            <div class="filter-form__group">
                                <label class="filter-form__label">Тип изделия</label>
                                <div class="filter-form__select-wrap">
                                    <select name="type" class="filter-form__select" onchange="this.form.submit()">
                                        <option value="">Все товары</option>
                                        <option value="stone" {{ request('type') == 'stone' ? 'selected' : '' }}>Драгоценные камни</option>
                                        <option value="jewelry" {{ request('type') == 'jewelry' ? 'selected' : '' }}>Украшения</option>
                                    </select>
                                    <i class="bi bi-chevron-down filter-form__select-arrow"></i>
                                </div>
                            </div>

                            {{-- 2. Цена --}}
                            <div class="filter-form__group">
                                <label class="filter-form__label">Цена, ₽</label>
                                <div class="filter-form__range">
                                    <input type="number" name="price_min" class="filter-form__input"
                                           placeholder="От" value="{{ request('price_min') }}">
                                    <span class="filter-form__range-divider">—</span>
                                    <input type="number" name="price_max" class="filter-form__input"
                                           placeholder="До" value="{{ request('price_max') }}">
                                </div>
                            </div>

                            {{-- 3. Категория --}}
                            <div class="filter-form__group">
                                <label class="filter-form__label">Категория</label>
                                <div class="filter-form__radios">
                                    <label class="filter-radio">
                                        <input type="radio" name="category_id" value=""
                                            {{ !request('category_id') ? 'checked' : '' }}>
                                        <span class="filter-radio__mark"></span>
                                        <span class="filter-radio__text">Все категории</span>
                                    </label>

                                    @foreach($categories as $cat)
                                        <label class="filter-radio" for="cat_{{ $cat->id }}">
                                            <input type="radio" name="category_id" id="cat_{{ $cat->id }}"
                                                   value="{{ $cat->id }}"
                                                {{ request('category_id') == $cat->id ? 'checked' : '' }}>
                                            <span class="filter-radio__mark"></span>
                                            <span class="filter-radio__text">{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- ====== ДИНАМИЧЕСКИЕ ФИЛЬТРЫ ====== --}}

                            {{-- Только для УКРАШЕНИЙ --}}
                            @if(request('type') === 'jewelry')
                                <div class="filter-form__group filter-form__group--dynamic">
                                    <div class="filter-form__group-tag">Украшения</div>
                                    <label class="filter-form__label">Материал</label>
                                    <div class="filter-form__select-wrap">
                                        <select name="material_id" class="filter-form__select">
                                            <option value="">Любой</option>
                                            @foreach($materials as $mat)
                                                <option value="{{ $mat->id }}" {{ request('material_id') == $mat->id ? 'selected' : '' }}>
                                                    {{ $mat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="bi bi-chevron-down filter-form__select-arrow"></i>
                                    </div>
                                </div>
                            @endif

                            {{-- Только для КАМНЕЙ --}}
                            @if(request('type') === 'stone')
                                <div class="filter-form__group filter-form__group--dynamic">
                                    <div class="filter-form__group-tag">Камни</div>
                                    <label class="filter-form__label">Минимальный вес, ct</label>
                                    <input type="number" step="0.01" name="stone_weight_min"
                                           class="filter-form__input"
                                           placeholder="0.00"
                                           value="{{ request('stone_weight_min') }}">
                                </div>
                            @endif

                            {{-- Кнопки --}}
                            <div class="filter-form__actions">
                                <button type="submit" class="filter-form__btn filter-form__btn--primary">
                                    <i class="bi bi-funnel"></i>
                                    Применить
                                </button>
                                <a href="{{ route('catalog.index') }}" class="filter-form__btn filter-form__btn--ghost">
                                    Сбросить
                                </a>
                            </div>

                        </form>
                    </div>
                </aside>
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
                            <div class="card product-card h-100 ">
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
                                    <h2 class="card-title text-white text-truncate">{{ $product->name }}</h2>
                                    <p class="text-gray-500 mb-2">{{ $product->sku }}</p>

                                    {{-- Характеристики (Полиморфные) --}}
                                    <div class="mb-3 text-secondary ">
                                        @if($product->productable_type === 'App\Models\Stone')
                                            Вес: <span class="text-white">{{ $product->productable->weight }} ct</span>
                                        @elseif($product->productable_type === 'App\Models\JewelryItem')
                                            Размер: <span class="text-white">{{ $product->productable->size }}</span>
                                        @endif
                                    </div>

                                    <div class="mt-auto d-flex flex-col justify-content-stretch w-48">
                                        <div class="price-tag"><span style="font-size: 24px">{{ number_format($product->price, 0, '.', ' ') }}₽</span></div>
                                        <a href="{{ route('cart.add', $product->id) }}" class="btn text-white mt-2 btn-primary" style="padding: 10px 5px;">
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

                {{-- Кнопка каталога --}}
                <button type="button" class="cart-btn fixed bottom-[15px] right-[15px]" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-bag text-4xl text-white"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
