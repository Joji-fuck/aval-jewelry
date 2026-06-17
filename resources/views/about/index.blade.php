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
    <div class="container">
        <section class="faq-page">
            <div>
                <div class="faq-header">
                    <h2 class="faq-header__title">Часто задаваемые вопросы</h2>
                    <p class="faq-header__subtitle">Ответы на самые популярные вопросы о наших украшениях и заказе</p>
                </div>

                <div class="faq-list">

                    {{-- Вопрос 1 --}}
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" data-faq-toggle="1">
                            <span class="faq-item__icon"></span>
                            <span class="faq-item__text">Можно ли заказать уникальное изделие по своему эскизу?</span>
                            <span class="faq-item__chevron">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                        </button>
                        <div class="faq-item__answer" data-faq-answer="1">
                            <div class="faq-item__answer-inner">
                                <p>Да, конечно! Мы создаём <strong>индивидуальный дизайн полностью бесплатно</strong> — вы платите только за готовое изделие.</p>
                                <p>Просто пришлите фото-референс, эскиз или опишите идею в WhatsApp или Telegram. Мы согласуем с вами 3D-модель будущего украшения до начала изготовления. Цена рассчитывается индивидуально и зависит от металла, камней и сложности работы.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Вопрос 2 --}}
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" data-faq-toggle="2">
                            <span class="faq-item__icon"></span>
                            <span class="faq-item__text">Сколько времени занимает изготовление заказа?</span>
                            <span class="faq-item__chevron">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                        </button>
                        <div class="faq-item__answer" data-faq-answer="2">
                            <div class="faq-item__answer-inner">
                                <p>Сроки зависят от типа заказа:</p>
                                <ul>
                                    <li><strong>Готовые изделия из каталога</strong> — отгрузка в день заказа.</li>
                                    <li><strong>Изделия на заказ</strong> — от 7 до 21 дня (зависит от сложности дизайна и наличия камней).</li>
                                </ul>
                                <p>Точные сроки мы называем после согласования 3D-модели — так вы заранее знаете, когда получите своё украшение.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Вопрос 3 --}}
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" data-faq-toggle="3">
                            <span class="faq-item__icon"></span>
                            <span class="faq-item__text">Как сделать заказ?</span>
                            <span class="faq-item__chevron">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                        </button>
                        <div class="faq-item__answer" data-faq-answer="3">
                            <div class="faq-item__answer-inner">
                                <p>Оформить заказ просто:</p>
                                <ol>
                                    <li>Выберите понравившееся изделие в каталоге.</li>
                                    <li>Укажите размер (если требуется).</li>
                                    <li>Добавьте товар в корзину и оформите заказ.</li>
                                </ol>
                                <p>Мы свяжемся с вами для подтверждения <strong>в течение 2 часов</strong> в рабочее время.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Вопрос 4 --}}
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" data-faq-toggle="4">
                            <span class="faq-item__icon"></span>
                            <span class="faq-item__text">Камни натуральные?</span>
                            <span class="faq-item__chevron">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                        </button>
                        <div class="faq-item__answer" data-faq-answer="4">
                            <div class="faq-item__answer-inner">
                                <p>Да, мы используем <strong>только натуральные драгоценные и полудрагоценные камни</strong> — никаких синтетических аналогов или имитаций.</p>
                                <p>По вашему желанию можем предоставить <strong>геммологический сертификат</strong> с подробными характеристиками камня: вес, цвет, чистота, огранка.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Вопрос 5 --}}
                    <div class="faq-item">
                        <button class="faq-item__question" type="button" data-faq-toggle="5">
                            <span class="faq-item__icon"></span>
                            <span class="faq-item__text">Есть ли у вас пробы и сертификаты?</span>
                            <span class="faq-item__chevron">
                        <i class="bi bi-chevron-down"></i>
                    </span>
                        </button>
                        <div class="faq-item__answer" data-faq-answer="5">
                            <div class="faq-item__answer-inner">
                                <p>Все изделия имеют <strong>именник мастерской</strong> и государственное <strong>пробирное клеймо</strong>, подтверждающее качество металла.</p>
                                <p>На драгоценные камни свыше определённой стоимости предоставляем геммологические <strong>сертификаты</strong> независимых лабораторий — это ваша гарантия подлинности и страховка при возможной перепродаже или оценке в будущем.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <div class="about-map h-100 w-100 rounded overflow-hidden border border-secondary shadow-lg" >
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad60dadf292073d325ad27bc1fc839c75d79e6a5854db2b374daf55224a85d29a&amp;width=100%&amp;height=400px&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>

    @include('layout.sections.footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.faq-item');

            items.forEach(item => {
                const button = item.querySelector('[data-faq-toggle]');
                const id = button.dataset.faqToggle;
                const answer = item.querySelector(`[data-faq-answer="${id}"]`);

                button.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');

                    // Закрываем все остальные
                    items.forEach(i => {
                        i.classList.remove('active');
                        const a = i.querySelector('.faq-item__answer');
                        if (a) a.style.maxHeight = null;
                    });

                    // Открываем текущий, если он был закрыт
                    if (!isActive) {
                        item.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    }
                });
            });
        });
    </script>
@endsection

