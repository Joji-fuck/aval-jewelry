@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container">
        <a style="font-size: 20px" class="btn text-white" href="{{route('crm.index')}}"><i class="bi bi-arrow-left-circle"></i> Назад</a>
        <h1 class="text-white mb-5">Редактирование характеристик</h1>
        <div class="container d-flex mb-5 flex-wrap">
            <div style="min-width: 320px" class="w-50 container">
                <h2 class="text-white">Материалы (изделия)</h2>
                <table class="table table-dark table-hover">
                    <button type="button" class="btn btn-success mb-3"
                            data-bs-toggle="modal"
                            data-bs-target="#createModal"
                            data-action="{{ route('crm.parameter.store', ['type' => 'materials']) }}"
                            data-title="Добавить материал">
                        Добавить
                    </button>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($materials as $material)
                        <tr>
                            <th scope="row">{{$material->id}}</th>
                            <td>{{$material->name}}</td>
                            <td>{{$material->slug}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        data-action="{{ route('crm.parameter.update', ['type' => 'materials', 'id' => $material->id]) }}"
                                        data-title="Редактировать: {{ $material->name }}"
                                        data-value="{{ $material->name }}"
                                        data-method="PUT">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('crm.parameter.destroy', ['type' => 'materials', 'id' => $material->id]) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Удалить запись {{ $material->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="min-width: 320px" class="w-50 container">
                <h2 class="text-white">Цвет (камни)</h2>
                <button type="button" class="btn btn-success mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#createModal"
                        data-action="{{ route('crm.parameter.store', ['type' => 'colors']) }}"
                        data-title="Добавить цвет">
                    Добавить
                </button>
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colors as $color)
                        <tr>
                            <th scope="row">{{$color->id}}</th>
                            <td>{{$color->name}}</td>
                            <td>{{$color->slug}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        data-action="{{ route('crm.parameter.update', ['type' => 'colors', 'id' => $color->id]) }}"
                                        data-title="Редактировать: {{ $color->name }}"
                                        data-value="{{ $color->name }}"
                                        data-method="PUT">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('crm.parameter.destroy', ['type' => 'colors', 'id' => $color->id]) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Удалить запись {{ $color->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container d-flex flex-wrap">
            <div style="min-width: 320px" class="w-50 container">
                <h2 class="text-white">Огранка (камни)</h2>
                <button type="button" class="btn btn-success mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#createModal"
                        data-action="{{ route('crm.parameter.store', ['type' => 'cuts']) }}"
                        data-title="Добавить огранку">
                    Добавить
                </button>
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cuts as $cut)
                        <tr>
                            <th scope="row">{{$cut->id}}</th>
                            <td>{{$cut->name}}</td>
                            <td>{{$cut->slug}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        data-action="{{ route('crm.parameter.update', ['type' => 'cuts', 'id' => $cut->id]) }}"
                                        data-title="Редактировать: {{ $cut->name }}"
                                        data-value="{{ $cut->name }}"
                                        data-method="PUT">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('crm.parameter.destroy', ['type' => 'cuts', 'id' => $cut->id]) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Удалить запись {{ $cut->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="min-width: 320px" class="w-50 container">
                <h2 class="text-white">Тип (камни)</h2>
                <button type="button" class="btn btn-success mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#createModal"
                        data-action="{{ route('crm.parameter.store', ['type' => 'types']) }}"
                        data-title="Добавить тип">
                    Добавить
                </button>
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <th scope="row">{{$type->id}}</th>
                            <td>{{$type->name}}</td>
                            <td>{{$type->slug}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        data-action="{{ route('crm.parameter.update', ['type' => 'types', 'id' => $type->id]) }}"
                                        data-title="Редактировать: {{ $type->name }}"
                                        data-value="{{ $type->name }}"
                                        data-method="PUT">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('crm.parameter.destroy', ['type' => 'types', 'id' => $type->id]) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Удалить запись {{ $type->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Модальное окно -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" method="POST" action="">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Добавить</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Название</label>
                            <input type="text" class="form-control" name="name" id="nameInput" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('gsap')
    <script src="{{ asset('js/modal.js') }}" defer></script>
@endsection
