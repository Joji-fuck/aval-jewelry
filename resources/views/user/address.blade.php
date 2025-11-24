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
            <form class="profile-right" action="{{route('profile.address.update')}}" method="post">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                @method('PATCH')
                <h3 class="text-white mb-3">Адрес доставки</h3>
                <div class="input-group mb-3">
                    <span class="input-group-text">Страна</span>
                    <input type="text" class="form-control" placeholder="(пусто)" aria-label="name" name="country" value="{{$profile->country}}">
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Город</span>
                        <input type="text" class="form-control" placeholder="(пусто)" aria-label="city" name="city" value="{{$profile->city}}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Улица</span>
                        <input type="text" class="form-control" placeholder="(пусто)" aria-label="street" name="street" value="{{$profile->street}}">
                        <span class="input-group-text">Дом</span>
                        <input type="text" class="form-control" placeholder="(пусто)" aria-label="house" name="house_number" value="{{$profile->house_number}}">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Индекс</span>
                        <input type="text"
                               maxlength="6"
                               inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,6)" class="form-control" placeholder="(пусто)" aria-label="zip_code" name="zip_code" value="{{$profile->zip_code}}">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Редактировать</button>
            </form>
        </div>
    </div>
@endsection
