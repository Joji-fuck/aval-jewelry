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
    <div class="about-gallery mt-5">
        <img src="{{asset('images/gallery/1.png')}}" alt="1" width="500px">
        <img src="{{asset('images/gallery/2.png')}}" alt="2" width="500px">
        <img src="{{asset('images/gallery/3.png')}}" alt="3" width="500px">
    </div>
    <div class="about-text">
        <section class="about-card relative bg-black rounded-3xl overflow-hidden shadow-2xl mx-auto max-w-7xl">
            <div class="absolute inset-0">
                <img src="{{asset('images/background.png')}}" class="w-full h-full object-cover opacity-60" alt="Background">
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>
            </div>
            <div class="relative z-10 p-12 lg:p-20 max-w-2xl">
                <h1 class="text-4xl md:text-5xl text-white font-serif mt-4 mb-6 leading-tight">
                    Ювелирная мастерская <span class="text-gray-300 italic">"Аваль"</span>
                </h1>
                <p class="text-gray-300 text-lg leading-relaxed mb-8">
                    Мы специализируемся на создании и реставрации ювелирных изделий, которые не просто выглядят безупречно, но и хранят ваши истории. Наши мастера предлагают полный спектр услуг: от изготовления эксклюзивных украшений по вашему дизайну до сложного ремонта и возвращения блеска фамильным драгоценностям. Каждое изделие создается с ювелирной точностью и вниманием к деталям, гарантируя высочайшее качество и долговечность. Мы помогаем сохранить то, что ценно, и создать то, что станет бесценным.
                </p>
                <p class="text-gray-300 text-lg leading-relaxed mb-8">Ювелирная мастерская "Аваль"</p>
            </div>
        </section>
    </div>



    <div class="about-map h-100 w-100 rounded overflow-hidden border border-secondary shadow-lg" >
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad60dadf292073d325ad27bc1fc839c75d79e6a5854db2b374daf55224a85d29a&amp;width=100%&amp;height=400px&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>


    @include('layout.sections.footer')
@endsection

