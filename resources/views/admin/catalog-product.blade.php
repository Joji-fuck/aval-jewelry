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
        <a href="{{route('crm.catalog-product.create')}}" class="btn btn-primary mb-3">Создать товар</a>
        <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Артикул (SKU)</th>
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Характеристики (Специфика)</th>
                    <th>Цена</th>
                    <th>Фото</th>
                    <th>Действия</th>
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

                        <td>{{ number_format($product->price, 2) }} ₽</td>

                        <td>
                            @if($product->images->isNotEmpty())
                                @foreach($product->images as $image)
                                    <a href="{{ asset('storage/' . $image->path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $image->path) }}"
                                             class="rounded border border-secondary"
                                             style="width: 60px; height: 60px; object-fit: cover;"
                                             alt="{{ $product->name }}">
                                    </a>
                                @endforeach
                            @else
                                <img src="{{ asset('storage/default.gif') }}"
                                     class="rounded border border-secondary opacity-50"
                                     style="width: 60px; height: 60px; object-fit: contain; background: #2b2b2b;"
                                     alt="Нет фото">
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('crm.catalog-product.edit', $product->id) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   title="Редактировать">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('crm.catalog-product.destroy', $product->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить {{ $product->name }}? Это действие нельзя отменить.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Удалить">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>

@endsection
