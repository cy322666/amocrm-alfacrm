<!DOCTYPE HTML>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

@include('site.bootstrapp')

<head>
    <meta charset="utf-8" />
    <meta property="og:title" content="Внедрение AmoCRM">
    <meta property="og:description" content="Внедрение и настройка amoCRM">
    <meta property="og:type" content="website">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>Внедрение AmoCRM и разработка</title>
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
                                <p class="pe-5">Поможем сопроводить уже работающую систему. Если часто появляются вопросы, предложения, замечания, то это Ваш случай</p>
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


{{--        что то --}}
            <section class="pt-3 pb-4" id="count-stats">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 mx-auto py-3">
                            <div class="row">
                                <div class="col-md-4 position-relative">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary"><span id="state1" countTo="70">0</span>+</h1>
                                        <h5 class="mt-3">Coded Elements</h5>
                                        <p class="text-sm font-weight-normal">From buttons, to inputs, navbars, alerts or cards, you are covered</p>
                                    </div>
                                    <hr class="vertical dark">
                                </div>
                                <div class="col-md-4 position-relative">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+</h1>
                                        <h5 class="mt-3">Design Blocks</h5>
                                        <p class="text-sm font-weight-normal">Mix the sections, change the colors and unleash your creativity</p>
                                    </div>
                                    <hr class="vertical dark">
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 text-center">
                                        <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                                        <h5 class="mt-3">Pages</h5>
                                        <p class="text-sm font-weight-normal">Save 3-4 weeks of work when you use our pre-made pages for your website</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        {{-- кейсы --}}
        <section class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-5">Check my latest blogposts</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src="../assets/img/examples/testimonial-6-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="javascript:;" class="text-dark font-weight-bold">Rover raised $65 million</a>
                                </h5>
                                <p>
                                    Finding temporary housing for your dog should be as easy as
                                    renting an Airbnb. That’s the idea behind Rover ...
                                </p>
                                <a href="javascript:;" class="text-info text-sm icon-move-right">Read More
                                    <i class="fas fa-arrow-right text-xs ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src="../assets/img/examples/testimonial-6-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="javascript:;" class="text-dark font-weight-bold">MateLabs machine learning</a>
                                </h5>
                                <p>
                                    If you’ve ever wanted to train a machine learning model
                                    and integrate it with IFTTT, you now can with ...
                                </p>
                                <a href="javascript:;" class="text-info text-sm icon-move-right">Read More
                                    <i class="fas fa-arrow-right text-xs ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-plain">
                            <div class="card-header p-0 position-relative">
                                <a class="d-block blur-shadow-image">
                                    <img src="../assets/img/examples/blog-9-4.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body px-0">
                                <h5>
                                    <a href="javascript:;" class="text-dark font-weight-bold">MateLabs machine learning</a>
                                </h5>
                                <p>
                                    If you’ve ever wanted to train a machine learning model
                                    and integrate it with IFTTT, you now can with ...
                                </p>
                                <a href="javascript:;" class="text-info text-sm icon-move-right">Read More
                                    <i class="fas fa-arrow-right text-xs ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="card card-blog card-background cursor-pointer">
                            <div class="full-background" style="background-image: url('../assets/img/examples/blog2.jpg')" loading="lazy"></div>
                            <div class="card-body">
                                <div class="content-left text-start my-auto py-4">
                                    <h2 class="card-title text-white">Flexible work hours</h2>
                                    <p class="card-description text-white">Rather than worrying about switching offices every couple years, you stay in the same place.</p>
                                    <a href="javascript:;" class="text-white text-sm icon-move-right">Read More
                                        <i class="fas fa-arrow-right text-xs ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <section class="py-5">

    @include('site.prefooter')

    </section>
    </div>


    @include('site.scripts')

    @include('site.footer')
</body>

</html>

