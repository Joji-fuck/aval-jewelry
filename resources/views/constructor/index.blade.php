{{-- resources/views/constructor/index.blade.php --}}

@extends('layout.layout')
@section('content')
    <div class="constructor-page">
        <div class="container">
            <h1 class="constructor-page__title">Конструктор кольца</h1>
            <p class="constructor-page__subtitle">Настройте параметры и оформите заказ</p>

            <div class="constructor-wrapper">
                {{-- ЛЕВАЯ ПАНЕЛЬ --}}
                <aside class="constructor-panel">
                    <div class="constructor-group">
                        <label class="constructor-group__label" for="ring-type">Тип кольца</label>
                        <div class="size-select-wrap">
                            <select id="ring-type" class="size-select">
                                <option value="Обручальное">Обручальное</option>
                                <option value="Помолвочное">Помолвочное</option>
                                <option value="Бесконечность">Бесконечность</option>
                            </select>
                            <svg class="size-select-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="constructor-group">
                        <label class="constructor-group__label" for="material">Материал</label>
                        <div class="size-select-wrap">
                            <select id="material" name="material_id" class="size-select">
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                            <svg class="size-select-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="constructor-group">
                        <label class="constructor-group__label" for="ring-size">Размер кольца</label>
                        <input type="number" id="ring-size" class="size-select" step="0.5" min="14" max="23" value="17">
                    </div>

                    <button id="next-btn" class="constructor-submit">Оформить заказ</button>
                </aside>

                {{-- ПРАВАЯ ЧАСТЬ — 3D --}}
                <div class="constructor-viewer">
                    @php $defaultModel = $ringModels->firstWhere('type', 'Обручальное'); @endphp

                    @if($defaultModel)
                        <model-viewer
                            id="ring-viewer"
                            src="{{ asset('storage/' . $defaultModel->model_path) }}"
                            alt="3D модель кольца"
                            camera-controls
                            auto-rotate
                            shadow-intensity="1"
                            exposure="1.1"
                            environment-image="neutral"
                            loading="eager">
                        </model-viewer>
                    @else
                        <div class="constructor-viewer__empty">Модели колец ещё не загружены</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        window.ringModels = @json(
        $ringModels->mapWithKeys(fn($m) => [
            $m->type => asset('storage/' . $m->model_path)
        ])
    );
    </script>

    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>

    <script>
        const viewer = document.getElementById('ring-viewer');
        const typeSelect = document.getElementById('ring-type');

        typeSelect.addEventListener('change', (e) => {
            if (viewer && window.ringModels[e.target.value]) {
                viewer.src = window.ringModels[e.target.value];
            }
        });

        document.getElementById('next-btn').addEventListener('click', () => {
            const params = new URLSearchParams({
                type: typeSelect.value,
                material_id: document.getElementById('material').value,
                ring_size: document.getElementById('ring-size').value,
            });
            window.location.href = `/constructor/checkout?${params}`;
        });
    </script>
@endsection

