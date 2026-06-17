@extends('layout.layout')
@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')
    <div class="container py-5 text-white">
        <section class="product-page">
            <div class="container">

                <div class="product-grid">

                    {{-- ===== ГАЛЕРЕЯ ===== --}}
                    <div class="product-gallery">
                        <div class="product-gallery__main" id="main-visual-container">
                            <img src="{{ asset('storage/' . ($product->images->first()->path ?? 'default.gif')) }}"
                                 id="mainImage"
                                 class="product-gallery__image"
                                 alt="{{ $product->name }}">

                            @if($product->models->isNotEmpty())
                                <model-viewer id="mainModel"
                                              src="{{ asset('storage/' . $product->models->first()->path) }}"
                                              poster="{{ asset('storage/' . ($product->images->first()->path ?? 'default.gif')) }}"
                                              alt="{{ $product->name }} 3D"
                                              ar camera-controls touch-action="pan-y"
                                              class="product-gallery__model"></model-viewer>
                            @endif
                        </div>

                        <div class="product-gallery__thumbs">
                            @foreach($product->images as $image)
                                <div class="product-gallery__thumb"
                                     onclick="showMedia('image', '{{ asset('storage/' . $image->path) }}')">
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                         alt="Фото {{ $product->name }}">
                                </div>
                            @endforeach

                            @if($product->models->isNotEmpty())
                                <div class="product-gallery__thumb product-gallery__thumb--3d"
                                     onclick="showMedia('model', '{{ asset('storage/' . $product->models->first()->path) }}')"
                                     title="3D-модель">
                                    <i class="bi bi-badge-3d"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ===== ИНФОРМАЦИЯ ===== --}}
                    <div class="product-info">
                        <div class="product-info__category">
                            @if($product->productable_type === \App\Models\Stone::class)
                                Драгоценные камни
                            @else
                                Изделия
                            @endif
                        </div>

                        <h1 class="product-info__title">{{ $product->name }}</h1>

                        <div class="product-info__sku">
                            Артикул: <span>{{ $product->sku ?? '0000' }}</span>
                        </div>

                        <div class="product-info__price-block">
                            <span class="product-info__price-label">Цена</span>
                            <div class="product-info__price">
                        <span class="product-info__price-value">
                            {{ number_format($product->price, 0, '.', ' ') }}
                        </span>
                                <span class="product-info__price-currency">₽</span>
                            </div>
                        </div>

                        <p class="product-info__description">
                            {{ $product->description ?? 'Краткое описание товара, основные преимущества и особенности.' }}
                        </p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="product-info__actions">
                            @csrf
                            <button type="submit" class="product-info__btn">
                                <i class="bi bi-bag-plus"></i>
                                <span>В корзину</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </section>
        <div class="row mt-5">
            <div class="product-specs">
                <h2 class="product-specs__title">Характеристики</h2>

                <div class="product-specs__list">
                    @if($product->productable_type === "App\\Models\\Stone")

                        <div class="product-specs__item">
                            <span class="product-specs__label">Размеры</span>
                            <span class="product-specs__value">10,99 × 10,07 × 6,97 мм</span>
                        </div>

                        <div class="product-specs__item">
                            <span class="product-specs__label">Фактическая масса</span>
                            <span class="product-specs__value">{{ $product->productable->weight }} карат</span>
                        </div>

                        <div class="product-specs__item">
                            <span class="product-specs__label">Огранка</span>
                            <span class="product-specs__value">{{ $product->productable->cut->name }}</span>
                        </div>

                        <div class="product-specs__item">
                            <span class="product-specs__label">Цвет</span>
                            <span class="product-specs__value">{{ $product->productable->color->name }}</span>
                        </div>

                    @else

                        <div class="product-specs__item">
                            <span class="product-specs__label">Размер</span>
                            <span class="product-specs__value">{{ $product->productable->size }} мм</span>
                        </div>

                        <div class="product-specs__item">
                            <span class="product-specs__label">Фактическая масса</span>
                            <span class="product-specs__value">{{ $product->productable->base_weight }} гр</span>
                        </div>

                        <div class="product-specs__item">
                            <span class="product-specs__label">Материал</span>
                            <span class="product-specs__value">{{ $product->productable->material->name }}</span>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function showMedia(type, source) {
            const mainImg = document.getElementById('mainImage');
            const mainModel = document.getElementById('mainModel');

            if (type === 'image') {
                mainImg.src = source;
                mainImg.style.display = 'block';
                if (mainModel) {
                    mainModel.style.display = 'none';
                }
            } else if (type === 'model') {
                mainImg.style.display = 'none';
                if (mainModel) {
                    mainModel.src = source;
                    mainModel.style.display = 'block';
                }
            }
        }
    </script>
@endsection
