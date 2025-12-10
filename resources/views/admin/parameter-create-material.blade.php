@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection


@section('content')
    <div class="container">
        <h1 class="text-white mb-5">Редактирование характеристик</h1>
        <div class="container d-flex">
            <form action="" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Имя">
                <button type="submit">Добавить</button>
            </form>
        </div>

    </div>

@endsection
