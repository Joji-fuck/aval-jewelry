@extends('layout.layout')

@section('gsap')
    <script src="{{ asset('js/accordion.js') }}" defer></script>
@endsection

@section('content')
{{--    <a class="shopping-cart" href="{{route('catalog.cart')}}">--}}
{{--        <img src="{{asset('images/icon/shopping-cart.svg')}}">--}}
{{--    </a>--}}
    <section class="catalog wrap">
        <aside class="catalog-filter">
            <div class="filter-top">
                <span>Фильтр</span>
                <a href="#">Сбросить все</a>
            </div>

            <form class="filter" action="{{route('catalog.store')}}" method="post">
                @csrf
                <div class="filter">
                    <a class="accordion">Цена</a>
                    <div class="panel">
                        <div class="inputs_price">
                            <input type="number" name="pricemin" class="input_price" placeholder="От">
                            <input type="number" name="pricemax" class="input_price" placeholder="До">
                        </div>
                        <button>Применить</button>
                    </div>

                    <a class="accordion">Тип изделия</a>
                    <div class="panel">
                        @foreach($categories as $category)
                            <label><input class="checkbox-item" type="checkbox" name="categories[]" value="{{$category->id}}">{{$category->name}}</label>
                        @endforeach
                        <button>Применить</button>
                    </div>

{{--                    <a class="accordion">Металл</a>--}}
{{--                    <div class="panel">--}}
{{--                        @foreach($materials as $material)--}}
{{--                            <label><input class="checkbox-item" type="checkbox" name="materials[]" value="{{$material->material}}">{{$material->material}}</label>--}}
{{--                        @endforeach--}}
{{--                        <button>Применить</button>--}}
{{--                    </div>--}}

{{--                    <a class="accordion">Камень</a>--}}
{{--                    <div class="panel">--}}
{{--                        @foreach($stones as $stone)--}}
{{--                            <label><input class="checkbox-item" type="checkbox" name="stones[]" value="{{$stone->stone}}">{{$stone->stone}}</label>--}}
{{--                        @endforeach--}}
{{--                        <button>Применить</button>--}}
{{--                    </div>--}}

{{--                    <a class="accordion">Цвет</a>--}}
{{--                    <div class="panel">--}}
{{--                        @foreach($colors as $color)--}}
{{--                            <label><input class="checkbox-item" type="checkbox" name="colors[]" value="{{$color->color}}">{{$color->color}}</label>--}}
{{--                        @endforeach--}}
{{--                        <button>Применить</button>--}}
{{--                    </div>--}}

                    <a class="accordion">Проба</a>
                    <div class="panel">
                        {{--                    <label><input class="checkbox-item" type="checkbox" name="options[]" value="gold">375</label>--}}
                        <button>Применить</button>
                    </div>



                    <div class="filter-buttons">
                        <button class="filter-button" type="submit">Применить</button>
                        <button class="filter-button">Сбросить</button>
                    </div>
                </div>
            </form>
        </aside>


        <section class="cards">
            <img class="img-main" src="{{asset('images/catalog-main.png')}}">

            <div class="cards-sort">
{{--                <span>Всего: {{$result}}</span>--}}
                <span>Всего: 12</span>
                <div class="cards-sort-button">
                    <span>Сортировка:</span>
                    <a href="#">
                        <span> Сначала недорогие</span>
                    </a>
                </div>
            </div>

            <div class="cards-all">
                <div class="card">
                    <img src="{{asset('images/card-example.png')}}">
                    <div class="card-bottom">
                        <span class="card-title">Тестовый</span>
                        <div class="card-bottom-price">
                            <s>120</s>
                            <span>100</span>
                        </div>
                        <div class="cards-bottom-buttons">
                            <button>В корзину</button>
                            <button>Купить сейчас</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>

@include('layout.sections.footer')
@endsection
