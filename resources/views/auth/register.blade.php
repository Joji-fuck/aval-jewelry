@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container" data-bs-theme="dark">
        <h1 class="text-white text-center mt-2 mb-2">Регистрация</h1>

        <form method="post" action="{{route('register.store')}}">
            @csrf
            <div class="d-flex justify-evenly gap-3">
                <div class="mb-3 flex-fill">
                    <label for="surname" class="form-label text-white">Фамилия</label>
                    <input type="text" name="surname" class="form-control" id="surname" aria-describedby="emailHelp" value="{{old('surname')}}">
                </div>
                <div class="mb-3 flex-fill">
                    <label for="name" class="form-label text-white">Имя</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{old('name')}}">
                </div>

            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Электронная почта</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}">
                <div id="emailHelp" class="form-text">Указывая электронную почту, вы НЕ даете свое согласие на рекламную рассылку</div>
            </div>
            <div class="mb-3">
                <label for="login" class="form-label text-white">Логин</label>
                <input type="text" class="form-control" name="login" id="login" aria-describedby="emailHelp" value="{{old('login')}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Пароль</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label text-white">Подтвердите пароль</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
        </form>
    </div>
@endsection
