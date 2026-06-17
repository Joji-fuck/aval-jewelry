@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container admin-menu text-center mt-5">
        <a class="admin-menu-button" href="{{route('crm.catalog-product.index')}}">
            <span>Каталог изделий</span>
        </a>
        <a class="admin-menu-button" href="{{route('crm.ring-orders.index')}}">
            <span>Конструктор</span>
        </a>
        <a class="admin-menu-button" href="{{route('crm.order.index')}}">
            <span>Заявки</span>
        </a>
        <a class="admin-menu-button" href="{{route('crm.parameter.index')}}">
            <span>Редактор характеристик</span>
        </a>
    </div>

@endsection
