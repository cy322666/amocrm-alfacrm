<!DOCTYPE HTML>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

@include('site.bootstrap')

<body class="index-page bg-gray-200">

    @include('site.nav')

    @include('site.header')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

        <section class="my-5 py-5">

            <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
                <div class="container py-7 postion-relative z-index-2 position-relative">
                    <div class="row">
                        <div class="col-md-7 mx-auto text-center">
                            <span class="badge bg-primary mb-3">Разработка</span>
                            <h2 class="text-white mb-0">Готовые решения не подходят?</h2>
                            <p class="lead">На этот вопрос есть ответ! Наша команда разработчиков может помочь решить большинство вопросов</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="mt-4 pb-4" id="count-stats">
            <div class="col-lg-9 mx-auto py-3">
                <div class="row">
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-primary"><span id="state1" countTo="70">400</span>+</h1>
                            <h5 class="mt-3">Разработок</h5>
                            <p class="text-sm font-weight-normal">Больших и маленьких: от микродоработок внутри amoCRM до полноценных кабинетов</p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4 position-relative">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span></h1>
                            <h5 class="mt-3">Клиентов</h5>
                            <p class="text-sm font-weight-normal">Отказались от разработки после релиза! Мы доводим дело до конца с высоким уровнем качества</p>
                        </div>
                        <hr class="vertical dark">
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 text-center">
                            <h1 class="text-gradient text-primary" id="state3" countTo="4">3+</h1>
                            <h5 class="mt-3">Лет</h5>
                            <p class="text-sm font-weight-normal">Средний стаж наших разработчиков в программировании. Только качественный код!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="col-lg-6 ms-auto pt-3 my-3">
            <div class="row justify-content-start">
                <div class="col-md-6">
                    <div class="info">
                        <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                        <h5 class="font-weight-bolder mt-3">Широкие возможности</h5>
                        <p class="pe-3">Практически неограниченный простор для доработки функционала системы: от небольших улучшений до полного преобразования системы</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                        <h5 class="font-weight-bolder mt-3">Техническое задание</h5>
                        <p class="pe-5">Поможем написать/доработать или напишем сами ТЗ, декомпозируем на задачи</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-start mt-5">
                <div class="col-md-6 mt-3">
                    <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                    <h5 class="font-weight-bolder mt-3">Современный стек</h5>
                    <p class="pe-5">Используем только новейшие технологии и фреймворки для разработки</p>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="info">
                        <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                        <h5 class="font-weight-bolder mt-3">Отправим исходники</h5>
                        <p class="pe-3">Напишем документацию, передадим код, предоставим поддержку своих кастомных решений</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-header py-6 py-md-8 my-sm-3 mb-6 border-radius-xl" style="background-image: url({{ asset('site/img/github2.jpeg') }});" loading="lazy">
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 ms-lg-5 text-center">
                    </div>
                </div>
            </div>
        </div>

        {{-- кейсы --}}
        <section class="py-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-5 pt-6">Наши кейсы</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src={{ asset("site/img/cases/bb.png") }} alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="https://wehaveideas.ru" class="text-dark font-weight-bold">BangBang Education</a>
                                </h5>
                                <p>Маркетинговое агенство</p>
                                <p>
                                    Подключили все источники лидов, настроили рассылки. Пробросили метки и подключили Ройстат
                                </p>
                                <p>
                                    Важно было обеспечить отслеживание источников трафика и рекламных компаний
                                </p>
                                {{--                                <a href="javascript:;" class="text-info text-sm icon-move-right">Read More--}}
                                {{--                                    <i class="fas fa-arrow-right text-xs ms-1"></i>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src={{ asset("site/img/cases/chillspa.png") }} alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="https://swedish-online.se" class="text-dark font-weight-bold">Chill Spa</a>
                                </h5>
                                <p>Онлайн Школа Шведского языка</p>
                                <p>
                                    Классический запрос: индивидуальная интеграция с
                                    Бизон365 и Геткурс. Подключили телефонию и обучили сотрудников
                                </p>
                                <p>
                                    Важно было обеспечить отслеживание оплат и заказов, посещение вебинаров и конверсию
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src={{ asset("site/img/cases/gigant.png") }} alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="https://residencesathrhdavos.com" class="text-dark font-weight-bold">GigAnt</a>
                                </h5>
                                <p>Продажа недвижимости в Швейцарии</p>
                                <p>
                                    Клиенты из разных стран: настроили прогрев по почте по каждому сегменту клиентов: язык, пол, возраст.
                                    Множество микродоработок внутри кабинета
                                </p>
                                <p>
                                    Важно было обеспечить максимально стабильную работу системы и множества индивидуальных узлов
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-blog card-background cursor-pointer">
                            <div class="full-background" style="background-color: black" loading="lazy"></div>
                            <div class="card-body">
                                <div class="content-left text-start my-auto py-4">
                                    <h2 class="card-title text-white">Другие кейсы</h2>
                                    <p class="card-description text-white">Посмотрите другие крутые кейсы нашей компании</p>
                                    <a href="javascript:;" class="text-white text-sm icon-move-right">Смотреть
                                        <i class="fas fa-arrow-right text-xs ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-12 my-auto">
                        <h3 class="text-gradient text-primary mb-0">Нет тех специалиста?</h3>
                        <h3>Нужна помощь?</h3>
                        <p class="pe-md-5 mb-4">
                            Не имея технического специалиста в штате сложно объективно оценить разработку, написать техническое задание, оценить затраты. Оставьте заявку на консультацию со специалистом, который поможет сформировать запрос или ответит на ваши вопросы по разработке
                        </p>
                        <div class="github-buttons">
                            <a href="#contact-form" class="btn bg-gradient-primary mb-5 mb-sm-0">Связаться</a>
                            <div class="github-button">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 my-auto">
                        {{--                            <a href="https://www.creative-tim.com/product/material-kit-pro?ref=index-mk2">--}}
                        <img class="w-100 border-radius-lg shadow-lg" src=" {{ asset('/site/img/code2.png') }}" alt="Product Image">
                        {{--                            </a>--}}
                    </div>
                </div>
            </div>
        </section>

        @include('site.prefooter')
    </div>

    @include('site.scripts')

    @include('site.footer')

</body>
</html>
