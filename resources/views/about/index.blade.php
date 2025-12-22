@extends('layout.layout')

@section('bootstrap-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endsection
@section('bootstrap-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
@endsection

{{--@section('gsap')--}}
{{--    @extends('layout.sections.gsap')--}}
{{--    <script src="{{ asset('js/about.js') }}" defer></script>--}}
{{--@endsection--}}

@section('content')
    <div class="text-white">
        <div class="container">

            {{-- Заголовок --}}
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h1 class="fw-bold display-4">О нас</h1>
                    <p class="lead text-white-50">Мы создаем лучшие решения для наших клиентов.</p>
                </div>
            </div>

            <div class="row g-5">
                {{-- Левая колонка: Текст и Контакты --}}
                <div class="col-lg-6 d-flex flex-column justify-content-center">

                    <div class="mb-5">
                        <h3 class="fw-bold mb-3">Кто мы такие?</h3>
                        <p class="text-white-50">
                            Аваль — команда профессионалов, увлеченных своим делом. Наша миссия — предоставлять качественные товары и безупречный сервис. Мы работаем на рынке уже более 5 лет и ценим доверие каждого клиента.
                        </p>
                        <p class="text-white-50">
                            В нашем каталоге вы найдете только проверенную продукцию. Мы гарантируем быструю доставку и поддержку на всех этапах покупки.
                        </p>
                    </div>

                    <div class="card bg-dark border-secondary text-white shadow-lg">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Наши контакты</h4>

                            <div class="mb-3 d-flex align-items-start">
                                <div class="me-3 text-white-50">📍</div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Адрес</h6>
                                    <span class="text-white-50">г. Тюмень, ул. Мельникайте, д. 125к1</span>
                                </div>
                            </div>

                            <div class="mb-3 d-flex align-items-start">
                                <div class="me-3 text-white-50">📞</div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Телефон</h6>
                                    <a href="tel:+79829009003" class="text-white text-decoration-none hover-underline">
                                        +7 (982) 900-90-03
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <div class="me-3 text-white-50">✉️</div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Email</h6>
                                    <a href="mailto:info@myshop.ru" class="text-white text-decoration-none">
                                        aval.llc@mail.ru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Правая колонка: Карта --}}
                <div class="col-lg-6">
                    <div class="h-100 w-100 rounded overflow-hidden border border-secondary shadow-lg" style="min-height: 450px;">
                        {{-- Скрипт Яндекс.Карт --}}
                        {{-- Важно: div-обертке я задал min-height, чтобы карта не схлопнулась --}}
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad60dadf292073d325ad27bc1fc839c75d79e6a5854db2b374daf55224a85d29a&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
