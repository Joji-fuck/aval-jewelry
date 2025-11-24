@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container" data-bs-theme="dark">
        <h1 class="text-white">Профиль</h1>
        <div class="profile">
            <aside class="profile-left">
                @include('user.layout.aside')
            </aside>
            <form class="profile-right" action="{{route('profile.index.update')}}" method="post">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                @method('PATCH')
                <h3 class="text-white mb-3">Основная информация</h3>
                <div class="input-group mb-3">
                    <span class="input-group-text">Имя</span>
                    <input type="text" class="form-control" placeholder="(пусто)" aria-label="name" name="name" value="{{$profile->name}}">
                    <span class="input-group-text">Фамилия</span>
                    <input type="text" class="form-control" placeholder="(пусто)" aria-label="surname" name="surname" value="{{$profile->surname}}">
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Отчество</span>
                        <input type="text" class="form-control" placeholder="(пусто)" aria-label="patronymic" name="patronymic" value="{{$profile->patronymic}}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">E-mail</span>
                        <input type="email" class="form-control" placeholder="(пусто)" aria-label="email" name="email" value="{{$profile->email}}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Телефон</span>
                        <input type="text" class="form-control" placeholder="(пусто)" aria-label="email" name="phone" value="{{$profile->phone}}">
                    </div>
                </div>
                <button class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
