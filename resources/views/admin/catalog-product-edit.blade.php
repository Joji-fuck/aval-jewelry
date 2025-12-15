@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')
    <style>
        .img-delete-wrapper { position: relative; display: inline-block; }
        .btn-delete-img {
            position: absolute; top: 5px; right: 5px;
            background: rgba(0,0,0,0.7); color: #fff; border: none;
            border-radius: 50%; width: 25px; height: 25px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
        }
        .card-dark {
            background-color: #1e1e1e;
            border: 1px solid #333;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        /* Поля ввода */
        .form-control-dark, .form-select-dark {
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #fff;
        }

        .form-control-dark::placeholder {
            color: #888;
            font-style: italic;
        }

        .form-control-dark:focus, .form-select-dark:focus {
            background-color: #333;
            border-color: #d4af37; /* Золотой */
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        /* Чекбокс */
        .form-check-input:checked {
            background-color: #d4af37;
            border-color: #d4af37;
        }

        .text-gold { color: #d4af37; }
        label { color: #aaa; font-size: 0.9rem; margin-bottom: 0.3rem; }

        /* Разделитель */
        hr.gold-line {
            border-top: 1px solid #d4af37;
            opacity: 0.3;
        }
    </style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="card card-dark">
                    <div class="card-header border-bottom border-secondary pt-4 pb-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 text-white">Редактирование: {{ $product->name }}</h4>

                            {{-- Кнопка удаления --}}
                            <form action="{{ route('crm.catalog-product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Удалить товар безвозвратно?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Удалить
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- Ошибки --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                            </div>
                        @endif

                        <form action="{{ route('crm.catalog-product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- ВАЖНО ДЛЯ ОБНОВЛЕНИЯ --}}

                            {{-- === ТИП ТОВАРА (ЗАБЛОКИРОВАН) === --}}
                            <div class="mb-4">
                                <label class="form-label text-gold fw-bold text-uppercase">Тип изделия</label>
                                <input type="text" class="form-control form-control-dark"
                                       value="{{ $product->productable_type === 'App\Models\Stone' ? '💎 Драгоценный камень' : '💍 Ювелирное украшение' }}"
                                       disabled readonly>
                                <input type="hidden" name="type" value="{{ $product->productable_type === 'App\Models\Stone' ? 'stone' : 'jewelry' }}">
                            </div>

                            {{-- === ОБЩИЕ ДАННЫЕ === --}}
                            <h5 class="text-white mb-3">Основная информация</h5>
                            <div class="row g-3 mb-3">
                                <div class="col-md-8">
                                    <label class="form-label">Название</label>
                                    <input type="text" name="name" class="form-control form-control-dark"
                                           value="{{ old('name', $product->name) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Категория</label>
                                    <select name="category_id" class="form-select form-select-dark">
                                        <option value="">Без категории</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control form-control-dark"
                                           value="{{ old('sku', $product->sku) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Цена</label>
                                    <input type="number" step="0.01" name="price" class="form-control form-control-dark"
                                           value="{{ old('price', $product->price) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Сток</label>
                                    <input type="number" name="stock" class="form-control form-control-dark"
                                           value="{{ old('stock', $product->stock) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Описание</label>
                                <textarea name="description" class="form-control form-control-dark" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="isPublished"
                                    {{ old('is_published', $product->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="isPublished">Опубликовано</label>
                            </div>

                            <hr class="border-secondary my-4">

                            {{-- === УПРАВЛЕНИЕ ФОТО === --}}
                            <h5 class="mb-3 text-white">Фотографии</h5>

                            {{-- Существующие фото --}}
                            @if($product->images->count() > 0)
                                <p class="text-muted small">Отметьте галочкой, чтобы удалить фото:</p>
                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    @foreach($product->images as $img)
                                        <div class="text-center">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $img->path) }}" class="rounded border border-secondary" style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="form-check mt-1 d-flex justify-content-center">
                                                <input class="form-check-input bg-danger border-danger" type="checkbox" name="delete_images[]" value="{{ $img->id }}" id="del_img_{{ $img->id }}">
                                                <label class="form-check-label ms-1 text-danger small" for="del_img_{{ $img->id }}">Удалить</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Загрузка новых --}}
                            <div class="mb-3">
                                <label class="form-label">Добавить новые фото</label>
                                <input type="file" name="photos[]" multiple class="form-control form-control-dark">
                            </div>


                            <hr class="border-secondary my-4">

                            {{-- === ПОЛЯ: ТОЛЬКО ДЛЯ КАМНЯ === --}}
                            @if($product->productable_type === 'App\Models\Stone')
                                <h5 class="mb-3 text-info">Характеристики камня</h5>
                                <div class="p-3 rounded" style="border: 1px dashed #0dcaf0; background: rgba(13, 202, 240, 0.05);">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Вес (ct)</label>
                                            {{-- Обращаемся к $product->productable->weight --}}
                                            <input type="number" step="0.001" name="stone_weight" class="form-control form-control-dark"
                                                   value="{{ old('stone_weight', $product->productable->weight) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Тип камня</label>
                                            <select name="type_id" class="form-select form-select-dark">
                                                @foreach($stoneTypes as $type)
                                                    <option value="{{ $type->id }}" {{ $product->productable->type_id == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Огранка</label>
                                            <select name="cut_id" class="form-select form-select-dark">
                                                <option value="">Не выбрано</option>
                                                @foreach($cuts as $cut)
                                                    <option value="{{ $cut->id }}" {{ $product->productable->cut_id == $cut->id ? 'selected' : '' }}>{{ $cut->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Цвет</label>
                                            <select name="color_id" class="form-select form-select-dark">
                                                <option value="">Не выбрано</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}" {{ $product->productable->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- === ПОЛЯ: ТОЛЬКО ДЛЯ УКРАШЕНИЯ === --}}
                            @if($product->productable_type === 'App\Models\JewelryItem')
                                <h5 class="mb-3 text-warning">Характеристики изделия</h5>
                                <div class="p-3 rounded" style="border: 1px dashed #ffc107; background: rgba(255, 193, 7, 0.05);">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Материал</label>
                                            <select name="material_id" class="form-select form-select-dark">
                                                @foreach($materials as $mat)
                                                    <option value="{{ $mat->id }}" {{ $product->productable->material_id == $mat->id ? 'selected' : '' }}>
                                                        {{ $mat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Размер</label>
                                            <input type="number" step="0.1" name="jewelry_size" class="form-control form-control-dark"
                                                   value="{{ old('jewelry_size', $product->productable->size) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Вес металла</label>
                                            <input type="number" step="0.01" name="base_weight" class="form-control form-control-dark"
                                                   value="{{ old('base_weight', $product->productable->base_weight) }}">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-end align-items-center mt-5">
                                <a href="{{ route('crm.catalog-product.index') }}" class="text-decoration-none text-white me-4">Отмена</a>
                                <button type="submit" class="btn btn-warning fw-bold px-5">СОХРАНИТЬ ИЗМЕНЕНИЯ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





