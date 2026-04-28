@extends('layout.layout')
@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')


    <div class="container py-5 text-white">

        <div class="product-3d-view">
            <model-viewer
                src="{{ asset('storage/models/Test.glb') }}"
                poster="{{ asset('storage/models/Test.glb') }}"
                alt="{{ $product->name . '_3D'}}"
                auto-rotate
                camera-controls
                shadow-intensity="1"
                environment-image="neutral"
                exposure="1.2">
            </model-viewer>
        </div>

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
{{--                    <span class="badge bg-warning text-dark me-2">Хит продаж</span>--}}
                    <span class="text-secondary">Артикул: {{ $product->sku ?? '0000' }}</span>
                </div>

                <div class="mb-3">
                    <span class="text-secondary">
                        @if($product->productable_id === "App\Models\Stone")
                            <span class="text-secondary">Категория: Драгоценные камни</span>
                        @else
                            <span class="text-secondary">Категория: Изделия</span>
                        @endif
                    </span>
                </div>

                <div class="fs-4 mb-4">
                    <span class="fw-bold text-primary">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                </div>

                <p class="lead text-secondary">
                    {{ $product->description ?? 'Краткое описание товара, основные преимущества и особенности.' }}
                </p>

{{--                 Блок добавления в корзину--}}
                <form action="{{ route('cart.add', $product->id) }}" class="d-flex align-items-center mb-4">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        В корзину
                    </button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-dark table-striped table-hover">
                    @if($product->productable_type === "App\Models\Stone")
                        <tbody>
                        <tr>
                            <th scope="row" class="w-25 text-secondary">Размеры, мм</th>
                            {{--Поменять--}}
                            <td>10,99х10,07х6,97</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-secondary">Фактическая масса, карат</th>
                            <td>{{ $product->productable->weight }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-secondary">Огранка</th>
                            <td>{{ $product->productable->cut->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-secondary">Цвет</th>
                            <td>{{ $product->productable->color->name }}</td>
                        </tr>
                        </tbody>
                    @else
                        <tbody>
                        <tr>
                            <th scope="row" class="w-25 text-secondary">Размеры, мм</th>
                            <td>{{ $product->productable->size }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25 text-secondary">Фактическая масса, гр</th>
                            <td>{{ $product->productable->base_weight }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-secondary">Материал</th>
                            <td>{{ $product->productable->material->name}}</td>
                        </tr>
                        </tbody>
                    @endif
                </table>
                </div>
            </div>
        </div>

    </div>
@endsection
