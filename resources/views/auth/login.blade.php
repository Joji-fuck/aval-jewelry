@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="container" data-bs-theme="dark">
        <h1 class="text-white text-center mt-2 mb-2">Вход</h1>

        @error('identity')
        <div class="alert alert-danger" role="alert">
            {{ $message }} попробуйте <a href="{{route('register.index')}}">Зарегистрироваться</a>
        </div>
        @enderror
        <form method="post" action="{{route('login.store')}}">
            @csrf
            <div class="mb-3">
                <label for="identity" class="form-label text-white">Логин или Электронная почта</label>
                <input type="text" class="form-control @error('identity') is-invalid @enderror" name="identity" value="{{old('identity')}}" id="identity" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white">Пароль</label>
                <input type="password" class="form-control @error('error') is-invalid @enderror" name="password" id="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label text-white" for="remember">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-success">Войти</button>
        </form>
    </div>
@endsection
