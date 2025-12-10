@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-white">Каталог изделий</h1>
        <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Артикул (SKU)</th>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Характеристики (Специфика)</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>

                        <td>
                            @if($product->productable_type === 'App\Models\Stone')
                                <span class="badge bg-info">Камень</span>
                            @elseif($product->productable_type === 'App\Models\JewelryItem')
                                <span class="badge bg-warning">Украшение</span>
                            @else
                                <span class="badge bg-secondary">Прочее</span>
                            @endif
                        </td>

                        <td>
                            @if($product->productable instanceof \App\Models\Stone)
                                <strong>Вес:</strong> {{ $product->productable->weight }} ct.<br>
                                <strong>Огранка:</strong> {{ $product->productable->cut->name ?? '-' }}<br>
                                <strong>Цвет:</strong> {{ $product->productable->color->name ?? '-' }}

                            @elseif($product->productable instanceof \App\Models\JewelryItem)
                                <strong>Материал:</strong> {{ $product->productable->material->name ?? '-' }}<br>
                                <strong>Размер:</strong> {{ $product->productable->size }}<br>
                                <strong>Вес изд.:</strong> {{ $product->productable->base_weight }} г.

                            @else
                                <span class="text-muted">Нет деталей</span>
                            @endif
                        </td>

                        <td>${{ number_format($product->price, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col">#</th>--}}
{{--                <th scope="col">Имя</th>--}}
{{--                <th scope="col">ЧПУ</th>--}}
{{--                <th scope="col">Артикул</th>--}}
{{--                <th scope="col">Описание</th>--}}
{{--                <th scope="col">Цена</th>--}}
{{--                <th scope="col">Кол-во</th>--}}
{{--                <th scope="col">Категория</th>--}}
{{--                <th scope="col">На продажу?</th>--}}
{{--                <th scope="col">Действия</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}

{{--            <tr>--}}
{{--                <th scope="row">1</th>--}}
{{--                <td>Mark</td>--}}
{{--                <td>Otto</td>--}}
{{--                <td>@mdo</td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
        </table>
    </div>

@endsection
