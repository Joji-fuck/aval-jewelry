@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')
    <style>
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
                            <h4 class="mb-0 text-white">Добавить позицию в каталог</h4>
                            <a href="{{ route('crm.catalog-product.index') }}" class="btn btn-outline-secondary btn-sm">
                                Назад к списку
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger bg-danger text-white border-0 mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('crm.catalog-product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- === 1. ВЫБОР ТИПА (ПОЛИМОРФ) === --}}
                            <div class="mb-4">
                                <label class="form-label text-gold fw-bold text-uppercase">Что добавляем?</label>
                                <select name="type" id="typeSelector" class="form-select form-select-dark form-select-lg">
                                    <option value="stone" {{ old('type') == 'stone' ? 'selected' : '' }}> Драгоценный камень</option>
                                    <option value="jewelry" {{ old('type') == 'jewelry' ? 'selected' : '' }}> Ювелирное украшение</option>
                                </select>
                            </div>

                            {{-- === 2. ОБЩИЕ ДАННЫЕ (Таблица Products + Дублирование в Stones) === --}}
                            <h5 class="text-white mb-3">Основная информация</h5>

                            <div class="row g-3 mb-3">
                                <div class="col-md-8">
                                    <label class="form-label">Название товара</label>
                                    <input type="text" name="name" class="form-control form-control-dark" placeholder="Напр. Изумруд Овал 0.5ct" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Категория</label>
                                    <select name="category_id" class="form-select form-select-dark">
                                        <option value="">Без категории</option>
                                        {{-- Передайте $categories из контроллера --}}
                                        @foreach($categories ?? [] as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Артикул (SKU)</label>
                                    <input type="text" name="sku" class="form-control form-control-dark" placeholder="CODE-001" value="{{ old('sku') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Цена (₽)</label>
                                    <input type="number" step="0.01" name="price" class="form-control form-control-dark" value="{{ old('price') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Остаток (Stock)</label>
                                    <input type="number" name="stock" class="form-control form-control-dark" value="{{ old('stock', 1) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Описание</label>
                                <textarea name="description" class="form-control form-control-dark" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1" id="isPublished" checked>
                                <label class="form-check-label text-white" for="isPublished">Опубликовать на сайте</label>
                            </div>

                            <hr class="gold-line my-4">

                            {{-- === 3. ПОЛЯ ДЛЯ КАМНЯ (STONE) === --}}
                            <div id="stoneFields">
                                <h5 class="mb-3 text-info"><i class="bi bi-gem"></i> Характеристики камня</h5>
                                <div class="p-3 rounded" style="border: 1px dashed #0dcaf0; background: rgba(13, 202, 240, 0.05);">
                                    <div class="row g-3">

                                        {{-- Тип камня (Рубин, Сапфир...) --}}
                                        <div class="col-md-6">
                                            <label class="form-label">Тип камня (Type ID)</label>
                                            <select name="type_id" class="form-select form-select-dark">
                                                <option value="">Выберите тип...</option>
                                                {{-- $stoneTypes из контроллера --}}
                                                @foreach($types ?? [] as $type)
                                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Вес (Carat)</label>
                                            <input type="number" step="0.001" name="stone_weight" class="form-control form-control-dark" value="{{ old('stone_weight') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Огранка (Cut)</label>
                                            <select name="cut_id" class="form-select form-select-dark">
                                                <option value="">Выберите...</option>
                                                {{-- $cuts из контроллера --}}
                                                @foreach($cuts ?? [] as $cut)
                                                    <option value="{{ $cut->id }}" {{ old('cut_id') == $cut->id ? 'selected' : '' }}>
                                                        {{ $cut->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Цвет (Color)</label>
                                            <select name="color_id" class="form-select form-select-dark">
                                                <option value="">Выберите...</option>
                                                {{-- $colors из контроллера --}}
                                                @foreach($colors ?? [] as $color)
                                                    <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                                        {{ $color->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- === 4. ПОЛЯ ДЛЯ УКРАШЕНИЯ (JEWELRY) === --}}
                            <div id="jewelryFields" class="d-none">
                                <h5 class="mb-3 text-warning"><i class="bi bi-gift"></i> Характеристики изделия</h5>
                                <div class="p-3 rounded" style="border: 1px dashed #ffc107; background: rgba(255, 193, 7, 0.05);">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Материал</label>
                                            <select name="material_id" class="form-select form-select-dark">
                                                <option value="">Выберите металл...</option>
                                                {{-- $materials из контроллера --}}
                                                @foreach($materials ?? [] as $mat)
                                                    <option value="{{ $mat->id }}" {{ old('material_id') == $mat->id ? 'selected' : '' }}>
                                                        {{ $mat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Размер</label>
                                            <input type="number" step="0.1" name="jewelry_size" class="form-control form-control-dark" placeholder="17.0" value="{{ old('jewelry_size') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Вес металла (гр)</label>
                                            <input type="number" step="0.01" name="base_weight" class="form-control form-control-dark" value="{{ old('base_weight') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="gold-line my-4">
                            <h5 class="mb-3 text-white"><i class="bi bi-camera"></i> Фотографии</h5>
                            <div class="mb-3">
                                <label class="form-label">Выберите файлы (можно несколько)</label>
                                <input type="file" name="photos[]" multiple class="form-control form-control-dark" accept="image/*" id="photoInput">
                                <div class="form-text text-white">Поддерживаются: JPG, PNG, WEBP. Макс 2Мб каждый.</div>
                            </div>
                            <div id="photoPreview" class="d-flex flex-wrap gap-3 mt-3"></div>

                            <hr class="gold-line my-4">
                            <h5 class="mb-3 text-white"><i class="bi bi-badge-3d"></i> 3D модель</h5>
                            <div class="mb-3">
                                <label class="form-label">Выберите файлы (только один GLB/GLTF)</label>
                                <input type="file" name="model_3d"
                                       class="form-control form-control-dark"
                                       accept=".glb,.gltf"
                                       id="modelInput">
                                <div class="form-text text-white">Поддерживаются: GLB. Макс 128Мб</div>
                            </div>
                            <div id="modelPreviewContainer" class="mt-3 d-none">
                                <p class="text-white small">Предпросмотр модели:</p>
                                <div style="width: 100%; height: 300px; background: #1a1a1a; border-radius: 10px overflow: hidden;">
                                    <model-viewer id="preview-3d"
                                                  style="width: 100%; height: 100%;"
                                                  camera-controls
                                                  auto-rotate
                                                  shadow-intensity="1">
                                    </model-viewer>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-5">
                                <a href="{{ route('crm.catalog-product.index') }}" class="text-decoration-none text-white me-4">Отмена</a>
                                <button type="submit" class="btn btn-warning fw-bold px-5 py-2">
                                    <i class="bi bi-check-lg"></i> СОХРАНИТЬ ТОВАР
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('photoPreview');
            previewContainer.innerHTML = ''; // Очистить старое

            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'position-relative';

                        // Стили превью в темной теме
                        imgDiv.innerHTML = `
                    <img src="${e.target.result}" class="rounded border border-secondary"
                         style="width: 100px; height: 100px; object-fit: cover;">
                `;
                        previewContainer.appendChild(imgDiv);
                    }

                    reader.readAsDataURL(file);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const typeSelector = document.getElementById('typeSelector');
            const stoneFields = document.getElementById('stoneFields');
            const jewelryFields = document.getElementById('jewelryFields');

            function toggleFields() {
                if (typeSelector.value === 'stone') {
                    stoneFields.classList.remove('d-none');
                    jewelryFields.classList.add('d-none');
                } else {
                    stoneFields.classList.add('d-none');
                    jewelryFields.classList.remove('d-none');
                }
            }

            typeSelector.addEventListener('change', toggleFields);
            toggleFields();
        });

        document.getElementById('modelInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const container = document.getElementById('modelPreviewContainer');
            const viewer = document.getElementById('preview-3d');

            if (file) {
                const url = URL.createObjectURL(file);
                viewer.src = url; // Загружаем файл в 3D плеер
                container.classList.remove('d-none'); // Показываем контейнер
            }
        });
    </script>
@endsection




