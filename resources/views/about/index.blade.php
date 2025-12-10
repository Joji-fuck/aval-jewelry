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
    <h1 class="text-white text-center mt-2 mb-2">О нас</h1>

    <div class="works text-center mt-4">
        <h2 class="text-white">Наши работы</h2>
        <h4 class="text-white">Более 5-ти лет на рынке!</h4>

        <div style="width: 50%" id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{asset('images/catalog-main.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>lorem</h5>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{asset('images/catalog-main.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>lorem</h5>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{asset('images/catalog-main.png')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>lorem</h5>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <section class="features-section py-5" style="background-color: #0f0f0f;">
        <div class="container">
            <!-- Заголовок -->
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="display-6 fw-bold text-uppercase text-white mb-3">Наши преимущества</h2>
                    <p class="text-white-50">Безупречный вкус и вековые традиции ювелирного мастерства.</p>
                    <div class="separator mx-auto mt-3"></div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Карточка 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-dark h-100 p-4 text-center rounded-1">
                        <div class="icon-wrapper-dark mb-4 mx-auto d-flex align-items-center justify-content-center rounded-circle">
                            <!-- Иконка теперь text-white -->
                            <i class="bi bi-gem fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">Авторский дизайн</h5>
                        <p class="text-secondary small mb-0">Создаем эксклюзивные украшения, существующие в единственном экземпляре.</p>
                    </div>
                </div>

                <!-- Карточка 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-dark h-100 p-4 text-center rounded-1">
                        <div class="icon-wrapper-dark mb-4 mx-auto d-flex align-items-center justify-content-center rounded-circle">
                            <i class="bi bi-hammer fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">Ручная работа</h5>
                        <p class="text-secondary small mb-0">Тепло рук мастера в каждом изгибе. Отказ от бездушной машинной штамповки.</p>
                    </div>
                </div>

                <!-- Карточка 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-dark h-100 p-4 text-center rounded-1">
                        <div class="icon-wrapper-dark mb-4 mx-auto d-flex align-items-center justify-content-center rounded-circle">
                            <i class="bi bi-patch-check fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">Пожизненная гарантия</h5>
                        <p class="text-secondary small mb-0">Мы уверены в качестве наших изделий и берем на себя их обслуживание.</p>
                    </div>
                </div>

                <!-- Карточка 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card-dark h-100 p-4 text-center rounded-1">
                        <div class="icon-wrapper-dark mb-4 mx-auto d-flex align-items-center justify-content-center rounded-circle">
                            <i class="bi bi-hourglass-split fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">Точность сроков</h5>
                        <p class="text-secondary small mb-0">Ваш подарок будет готов точно к важной дате. Пунктуальность — наш приоритет.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map" style="height: 400px;">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad60dadf292073d325ad27bc1fc839c75d79e6a5854db2b374daf55224a85d29a&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
@endsection
