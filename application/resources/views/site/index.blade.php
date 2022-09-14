<!DOCTYPE HTML>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

@include('site.bootstrapp')

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <link rel="apple-touch-icon" sizes="76x76" href={{ asset("site/img/apple-icon.png") }}>
    <link rel="icon" type="image/png" href={{ asset("site/img/favicon.png") }}>

    <title>BLACK CLEVER</title>
</head>

<body class="index-page bg-gray-200">

    @if(session()->has('status'))

        <script>
            alert('Успешно отправлено');
        </script>

    @endif

    @include('site.nav')

    @include('site.header')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

    <section class="my-5 py-5">

        <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
            <div class="container py-7 postion-relative z-index-2 position-relative">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <span class="badge bg-primary mb-3">Внедрение amoCRM</span>
                        <h2 class="text-white mb-0">Отдел продаж</h2>
                        <h3 class="text-white mb-0">Единственный отдел, который зарабатывает деньги в компании</h3>
                        <p class="lead">Остальные отделы их тратят</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-sm-5 mt-3">
            <div class="row">
                <div class="col-lg-3">
                    <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                        <h3>Зачем это нужно?</h3>
                        <h6 class="text-secondary font-weight-normal pe-3">В чем польза автоматизации компании и стоит ли тратить деньги</h6>
                    </div>
                </div>

                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">fast_forward</i>
                                <h5 class="font-weight-bolder mt-3">Скорость</h5>
                                <p class="pe-5">Работа с клиентами осуществляется быстрее, за счет оптимизированных бизнес-процессов и их автоматизации</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">border_style</i>
                                <h5 class="font-weight-bolder mt-3">Прозрачность</h5>
                                <p class="pe-3">Система позволяет мониторить действия менеджеров вплоть до клика в режиме реального времени</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-icons text-gradient text-primary text-3xl">auto_graph</i>
                            <h5 class="font-weight-bolder mt-3">Эффективность</h5>
                            <p class="pe-5">Согласно исследованиям, эффективность отдела повышается в среднем на 40%. Также в разы возрастает количество клиентов на одного менеджера</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">equalizer</i>
                                <h5 class="font-weight-bolder mt-3">Аналитика</h5>
                                <p class="pe-3">Не выходя из amoCRM можно строить отчеты по многим показателям, которые ранее не были доступны</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">network_wifi_3_bar</i>
                                <h5 class="font-weight-bolder mt-3">Мобильность</h5>
                                <p class="pe-3">Все что нужно для работы - браузер и интернет. Также есть удобное приложения для телефона</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">security</i>
                                <h5 class="font-weight-bolder mt-3">Безопасность</h5>
                                <p class="pe-3">Возможность гибко настроить права доступа для сотрудников. Также есть решения, которые могут усилить меры безопасности</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-sm-5">
                    <div class="page-header py-6 py-md-5 my-sm-3 mb-3 border-radius-xl" style="background-image: url({{ asset('site/img/crm.jpeg') }});" loading="lazy">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 ms-lg-5">
{{--                                    <h4 class="text-white">Built by developers</h4>--}}
                                    <h1 class="text-white">Комплексное внедрение</h1>
                                    <p class="lead text-white opacity-6">Мы предлагаем комплекс услуг, направленных на автоматизацию бизнес-процессов компании</p>
{{--                                    <p> В работе участвуют: проектный менеджер, бизнес-аналитик, технический специалист и разработчик</p>--}}
                                    <a href="#contact-form" class="text-white icon-move-right">
                                        Получить консультацию
                                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4">
                                <i class="material-icons text-white text-3xl">flag</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <h5 class="text-white">Аудит</h5>
                                    <p class="text-white">Поиск болей и пожеланий к работе и создание диаграмм и технического задания</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 px-lg-1 mt-lg-0 mt-4">
                            <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4 h-100">
                                <i class="material-icons text-gradient text-primary text-3xl">precision_manufacturing</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <h5>Внедрение</h5>
                                    <p>Выполнение работ по настройке, интеграции и доработкам</p>
                                    <a href="#contact-form" class="text-primary icon-move-right">
                                        Оставить заявку
                                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4">
                                <i class="material-icons text-gradient text-primary text-3xl">receipt_long</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <h5>Обучение</h5>
                                    <p>После выполнения работ важно обучить сотрудников правильной работе и помочь стартовать</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-sm-7 mt-3">
            <div class="row">
                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                                <h5 class="font-weight-bolder mt-3">Сопровождение</h5>
                                <p class="pe-5">Поможем </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                                <h5 class="font-weight-bolder mt-3">Следующий этап</h5>
                                <p class="pe-3">Целый торт сложнее съесть сразу, чем по частям. Также и внедрение можно разделить на этапы. Всегда есть что улучшить</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                            <h5 class="font-weight-bolder mt-3">Доработки</h5>
                            <p class="pe-5">Часто нет готовых решений для решения задач. После базового внедрения и знакомства с СРМ, можно усложнять систему разработкой</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                                <h5 class="font-weight-bolder mt-3">На связи</h5>
                                <p class="pe-3">После выполнения работ остаемся на связи, всегда рады помочь!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                        <h3>Хорошо, а что потом?</h3>
                        <h6 class="text-secondary font-weight-normal pe-3">Базовое внедрение выполнено, менеджеры познакомились с системой, какие дальнейшие действия?</h6>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="row text-center my-sm-5 mt-5">
                            <div class="col-lg-6 mx-auto">
                                <span class="badge bg-primary mb-3">Важно</span>
                                <h2 class="">Менеджмент</h2>
                                <p class="lead">Хорошее внедрение - это прежде всего хороший менеджмент. Мы делаем на этом большой упор, в этом помогают крутые сервисы</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('site.asana')

        @include('site.miro')

    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="row text-center my-sm-5 mt-5">
                    <div class="col-lg-6 mx-auto">
                        <span class="badge bg-primary mb-3">CLEVER PLATFORM</span>
                        <h2 class="">Платформа готовых решений</h2>
                        <a href="#platform"></a>
{{--                        TODO --}}
                        <p class="lead">В основном у компаний похожие запросы. Для этого мы ведем разработку платформы</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">

                @include('site.widgets')

                <div class="col-md-3 mx-auto mt-md-0 mt-5">
                    <div class="position-sticky" style="top:100px !important">
                        <h4 class="">CLEVER PLATFORM</h4>
                        <h6 class="text-secondary font-weight-normal">Подключи платформу к amoCRM и используй виджеты по выбору. Количество решений постоянно растет!</h6>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="row text-center my-sm-8 mt-4">
                        <div class="col-lg-6 mx-auto">
{{--                            TODO--}}
                            <span class="badge bg-primary mb-3">Разработка</span>
                            <h2 class="">Готовые решения не подходят?</h2>
                            <p class="lead">И на этот вопрос есть ответ! Наша команда разработчиков может помочь решить большинство вопросов</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-header py-6 py-md-8 my-sm-3 mb-3 border-radius-xl" style="background-image: url({{ asset('site/img/github2.jpeg') }});" loading="lazy">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-11 ms-lg-5 text-center">
                        </div>
                    </div>
                </div>
            </div>

            <section class="my-7 py-5">
                <div class="container">
                    <div class="row align-items-center">
{{--                        <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">--}}
{{--                            <div class="rotating-card-container">--}}
{{--                                <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">--}}
{{--                                    <div class="front front-background" style="background: black; background-size: cover;">--}}
{{--                                        <div class="card-body py-7 text-center">--}}
{{--                                            <i class="material-icons text-white text-4xl my-3">touch_app</i>--}}
{{--                                            <h3 class="text-white">Навести</h3>--}}
{{--                                            <p class="text-white opacity-8">All the Bootstrap components that you need in a development have been re-design with the new look.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="back back-background" style="background-image: url({{ asset('site/img/github2.jpeg') }}); background-size: cover;">--}}
{{--                                        <div class="card-body pt-7 text-center">--}}
{{--                                            <h3 class="text-white">Связаться</h3>--}}
{{--                                            <p class="text-white opacity-8"> You will save a lot of time going from prototyping to full-functional code because all elements are implemented.</p>--}}
{{--                                            <a href="#contact-form" target="_blank" class="btn btn-white btn-sm w-50 mx-auto mt-3">Связаться</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-lg-6 ms-auto">
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
                                    <p class="pe-5">Используем только новейшие технологии и фреймоврки для разработки</p>
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
                                Не имея технического специалиста в штате сложно объекивно оценить разработку, написать техническое задание, оценить затраты. Оставьте заявку на консультацию со специалистом, который поможет сформировать запрос или ответит на ваши вопросы по разработке
                            </p>
                            <div class="github-buttons">
                                <a href="#contact-form" class="btn bg-gradient-primary mb-5 mb-sm-0">Связаться</a>
                                <div class="github-button">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 my-auto">
                            <a href="https://www.creative-tim.com/product/material-kit-pro?ref=index-mk2">
                                <img class="w-100 border-radius-lg shadow-lg" src=" {{ asset('/site/img/code2.png') }}" alt="Product Image">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    @include('site.prefooter')

    </section>
    </div>

{{--    @include('site.footer')--}}

{{--    amochat   --}}
    <script>
        (function(a,m,o,c,r,m){a[m]={id:"290181",hash:"d0b625ed48b9390dbeca8ed9ac0b8f1e771dd8be82080abcbc7f4fa429ca7749",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js?1663159216';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));
    </script>
</body>

</html>

{{--    TODO цифры--}}
{{--    <section class="pt-3 pb-4" id="count-stats">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-9 mx-auto py-3">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4 position-relative">--}}
{{--                            <div class="p-3 text-center">--}}
{{--                                <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>--}}
{{--                                <h5 class="mt-3">Coded Elements</h5>--}}
{{--                                <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or cards, you are covered</p>--}}
{{--                            </div>--}}
{{--                            <hr class="vertical dark">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4 position-relative">--}}
{{--                            <div class="p-3 text-center">--}}
{{--                                <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+</h1>--}}
{{--                                <h5 class="mt-3">Design Blocks</h5>--}}
{{--                                <p class="text-sm font-weight-normal">Mix the sections, change the colors and unleash your creativity</p>--}}
{{--                            </div>--}}
{{--                            <hr class="vertical dark">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="p-3 text-center">--}}
{{--                                <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>--}}
{{--                                <h5 class="mt-3">Pages</h5>--}}
{{--                                <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our pre-made pages for your website</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
