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
            <form class="profile-right" action="{{route('profile.password.update')}}">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                @method('PATCH')
                <h3 class="text-white mb-3">Смена пароля</h3>
                <div class="input-group mb-3">
                    <span class="input-group-text">Старый пароль</span>
                    <input type="password" autofocus class="form-control" name="old_password" aria-label="old_password">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Новый пароль</span>
                    <input type="password" class="form-control" aria-label="password" name="password" value="{{$profile->country}}">
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Подтвердите новый пароль</span>
                        <input type="password" class="form-control" aria-label="password_confirmation" name="password_confirmation" value="{{$profile->city}}">
                    </div>
                </div>
                <button class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
