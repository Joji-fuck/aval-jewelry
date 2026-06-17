@extends('layout.layout')

@section('gsap')
    @extends('layout.sections.gsap')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

@section('content')
    <section class="main">
        <div data-speed=".75" class="main-text">
            <h1>Аваль</h1>
            <h2>Ювелирная мастерская</h2>
        </div>
        <div class="main-img" data-speed=".6">
            <img  src="{{asset('images/main-stone.png')}}" alt="Камень">
        </div>
    </section>

    <section class="menu wrap">
        <div class="menu-content">
            <a href="{{route('catalog.index')}}" id="img-1">
                <div class="blue-line"></div>
                <div class="red-square"></div>
                <img src="{{asset('images/ring-main.png')}}" alt="Кольцо">
            </a>
            <div class="menu-text" id="text-1">
                <span>Каталог<br>украшений</span>
                <span>Ювелирные изделия,<br> которые вдохновляют и восхищают</span>
            </div>
        </div>
    </section>
    <section class="menu wrap">
        <div class="menu-content">
            <a href="{{route('constructor.index')}}" id="img-2">
                <div class="blue-line"></div>
                <div class="green-circle"></div>
                <img src="{{asset('images/stone-main.png')}}" alt="Кольцо">
            </a>
            <div class="menu-text" id="text-2">
                <span>Конструктор<br>изделий</span>
                <span>Только лучшие образцы<br>с безупречной огранкой</span>
            </div>
        </div>
    </section>
    <section class="menu wrap">
        <div class="menu-content">
            <a href="{{route('catalog.index')}}" id="img-3">
                <div class="blue-line"></div>
                <div class="orange-triangle"></div>
                <img src="{{asset('images/work-main.png')}}" alt="Кольцо">
            </a>
            <div class="menu-text" id="text-3">
                <span>О нас</span>
                <span>Ювелирная мастерская Аваль<br>Это высокое качество и уникальность работ</span>
            </div>
        </div>
    </section>

    <br/>
    <br/>
    <br/>
@endsection


