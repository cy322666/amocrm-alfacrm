<!DOCTYPE HTML>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

@include('site.bootstrapp')

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href={{ asset("img/apple-icon.png") }}>
    <link rel="icon" type="image/png" href={{ asset("img/favicon.png") }}>

    <title>Material Kit 2 by Creative Tim</title>
</head>

<body class="index-page bg-gray-200">

    @include('site.nav')

    @include('site.header')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

    <section class="my-5 py-5">

        <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
            <img src={{ asset("shapes/waves-white.svg") }} alt="pattern-lines" class="position-absolute start-0 top-md-0 w-100 opacity-2" alt="">
            <div class="container py-7 postion-relative z-index-2 position-relative">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <span class="badge bg-primary mb-3">Внедрение amoCRM</span>
                        <h2 class="text-white mb-0">Отдел продаж</h2>
                        <h3 class="text-white mb-0">Единственный отдел, который зарабатывает деньги в компании</h3>
                        <p class="lead">Остальные отделы его тратят</p>
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
{{--                background-color: #f4312c;--}}
                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">fast_forward</i>
                                <h5 class="font-weight-bolder mt-3">Скорость</h5>
                                <p class="pe-5">Built by developers for developers. Check the foundation and you will find everything inside our documentation.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">border_style</i>
                                <h5 class="font-weight-bolder mt-3">Прозрачность</h5>
                                <p class="pe-3">The world’s most popular front-end open source toolkit, featuring Sass variables and mixins.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-icons text-gradient text-primary text-3xl">auto_graph</i>
                            <h5 class="font-weight-bolder mt-3">Эффективность</h5>
                            <p class="pe-5">Creating your design from scratch with dedicated designers can be very expensive. Start with our Design System.</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">equalizer</i>
                                <h5 class="font-weight-bolder mt-3">Аналитика</h5>
                                <p class="pe-3">Regardless of the screen size, the website content will naturally fit the given resolution.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">network_wifi_3_bar</i>
                                <h5 class="font-weight-bolder mt-3">Мобильность</h5>
                                <p class="pe-3">The world’s most popular front-end open source toolkit, featuring Sass variables and mixins.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">security</i>
                                <h5 class="font-weight-bolder mt-3">Безопасность</h5>
                                <p class="pe-3">Regardless of the screen size, the website content will naturally fit the given resolution.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- -------- START Content Presentation Docs ------- -->
                <div class="container mt-sm-5">
                    <div class="page-header py-6 py-md-5 my-sm-3 mb-3 border-radius-xl" style="background-image: url({{ asset('img/crm.jpeg') }});" loading="lazy">
                        <span class="mask bg-gradient-dark"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 ms-lg-5">
                                    <h4 class="text-white">Built by developers</h4>
                                    <h1 class="text-white">Комплексное внедрение</h1>
                                    <p class="lead text-white opacity-8">Мы предлагаем комплекс услуг, направленных на автоматизацию бизнес-процессов компании</p>
{{--                                    <p> В работе участвуют: проектный менеджер, бизнес-аналитик, технический специалист и разработчик</p>--}}
                                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit" class="text-white icon-move-right">
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
                                    {{--                        <a href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit" class="text-white icon-move-right">--}}
                                    {{--                            Let's start--}}
                                    {{--                            <i class="fas fa-arrow-right text-sm ms-1"></i>--}}
                                    {{--                        </a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 px-lg-1 mt-lg-0 mt-4">
                            <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4 h-100">
                                <i class="material-icons text-gradient text-primary text-3xl">precision_manufacturing</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <h5>Внедрение</h5>
                                    <p>Выполнение работ по настройке, интеграции и доработкам</p>
                                    {{--                        <a href="https://www.creative-tim.com/learning-lab/bootstrap/datepicker/material-kit" class="text-primary icon-move-right">--}}
                                    {{--                            Read more--}}
                                    {{--                            <i class="fas fa-arrow-right text-sm ms-1"></i>--}}
                                    {{--                        </a>--}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="info-horizontal bg-gray-100 border-radius-xl d-block d-md-flex p-4">
                                <i class="material-icons text-gradient text-primary text-3xl">receipt_long</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <h5>Обучение</h5>
                                    <p>После выполнения работ важно обучить сотрудников правильной работе и помочь стартовать</p>
                                    {{--                        <a href="https://www.creative-tim.com/learning-lab/bootstrap/utilities/material-kit" class="text-primary icon-move-right">--}}
                                    {{--                            Read more--}}
                                    {{--                            <i class="fas fa-arrow-right text-sm ms-1"></i>--}}
                                    {{--                        </a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------- END Content Presentation Docs ------- -->
                <div class="container">
                    <div class="row">
                        <div class="row text-center my-sm-5 mt-5">
                            <div class="col-lg-6 mx-auto">
                                <span class="badge bg-primary mb-3">Boost creativity</span>
                                <h2 class="">With our coded pages1</h2>
                                <p class="lead">The easiest way to get started is to use one of our <br /> pre-built example pages. </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <div class="container mt-sm-5 mt-3">
            <div class="row">
                <div class="col-lg-3">
                    <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
                        <h3>Хорошо, а что потом?</h3>
                        <h6 class="text-secondary font-weight-normal pe-3">70+ carefully crafted small elements that come with multiple colors and shapes. These are only a few of them.</h6>
                    </div>
                </div>

                <div class="col-lg-6 ms-auto">
                    <div class="row justify-content-start">
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                                <h5 class="font-weight-bolder mt-3">Full Documentation</h5>
                                <p class="pe-5">Built by developers for developers. Check the foundation and you will find everything inside our documentation.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                                <h5 class="font-weight-bolder mt-3">Bootstrap 5 Ready</h5>
                                <p class="pe-3">The world’s most popular front-end open source toolkit, featuring Sass variables and mixins.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-5">
                        <div class="col-md-6 mt-3">
                            <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                            <h5 class="font-weight-bolder mt-3">Save Time & Money</h5>
                            <p class="pe-5">Creating your design from scratch with dedicated designers can be very expensive. Start with our Design System.</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="info">
                                <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                                <h5 class="font-weight-bolder mt-3">Fully Responsive</h5>
                                <p class="pe-3">Regardless of the screen size, the website content will naturally fit the given resolution.</p>
                            </div>
                        </div>
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


{{--            <section class="py-7">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-6 mx-auto text-center">--}}
{{--                            <h2 class="mb-0">Trusted by over</h2>--}}
{{--                            <h2 class="text-gradient text-primary mb-3">1,679,477+ web developers</h2>--}}
{{--                            <p class="lead">Many Fortune 500 companies, startups, universities and governmental institutions love Creative Tim's products. </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <hr class="horizontal dark my-5">--}}
{{--                </div>--}}
{{--            </section>--}}

            <div class="container">
                <div class="row">
                    <div class="row text-center my-sm-8 mt-4">
                        <div class="col-lg-6 mx-auto">
                            <span class="badge bg-primary mb-3">Разработка</span>
                            <h2 class="">Готовые решения не подходят?</h2>
                            <p class="lead">И на этот вопрос есть ответ! Наша команда разработчиков может помочь решить большинство вопросов</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-header py-6 py-md-8 my-sm-3 mb-3 border-radius-xl" style="background-image: url({{ asset('img/github2.jpeg') }});" loading="lazy">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-11 ms-lg-5 text-center">
{{--                            <h4 class="text-white">Built by developers</h4>--}}
{{--                            <h1 class="text-white" style="color: red">Комплексное внедрение</h1>--}}
{{--                            <p class="lead text-white opacity-10">Мы предлагаем комплекс услугг, направленных на автоматизацию бизнес-процессов компании</p>--}}
                        </div>
                    </div>
                </div>
            </div>

            <section class="my-5 py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                            <div class="rotating-card-container">
                                <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                                    <div class="front front-background" style="background: red; background-size: cover;">
                                        <div class="card-body py-7 text-center">
                                            <i class="material-icons text-white text-4xl my-3">touch_app</i>
                                            <h3 class="text-white">Feel the <br /> Material Kit</h3>
                                            <p class="text-white opacity-8">All the Bootstrap components that you need in a development have been re-design with the new look.</p>
                                        </div>
                                    </div>
                                    <div class="back back-background" style="background-image: url({{ asset('img/github2.jpeg') }}); background-size: cover;">
                                        <div class="card-body pt-7 text-center">
                                            <h3 class="text-white">Связаться</h3>
                                            <p class="text-white opacity-8"> You will save a lot of time going from prototyping to full-functional code because all elements are implemented.</p>
                                            <a href=".//sections/page-sections/hero-sections.html" target="_blank" class="btn btn-white btn-sm w-50 mx-auto mt-3">Связаться</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ms-auto">
                            <div class="row justify-content-start">
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-gradient text-primary text-3xl">flip_to_front</i>
                                        <h5 class="font-weight-bolder mt-3">Широкие возможности</h5>
                                        <p class="pe-3">The world’s most popular front-end open source toolkit, featuring Sass variables and mixins.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info">
                                        <i class="material-icons text-gradient text-primary text-3xl">content_copy</i>
                                        <h5 class="font-weight-bolder mt-3">Техническое задание</h5>
                                        <p class="pe-5">Built by developers for developers. Check the foundation and you will find everything inside our documentation.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-start mt-5">
                                <div class="col-md-6 mt-3">
                                    <i class="material-icons text-gradient text-primary text-3xl">price_change</i>
                                    <h5 class="font-weight-bolder mt-3">Современный стек</h5>
                                    <p class="pe-5">Creating your design from scratch with dedicated designers can be very expensive. Start with our Design System.</p>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="info">
                                        <i class="material-icons text-gradient text-primary text-3xl">devices</i>
                                        <h5 class="font-weight-bolder mt-3">Отправим исходники</h5>
                                        <p class="pe-3">Regardless of the screen size, the website content will naturally fit the given resolution.</p>
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
                            <h3 class="text-gradient text-primary mb-0">You liked it and</h3>
                            <h3>Want more?</h3>
                            <p class="pe-md-5 mb-4">
                                Most complex and innovative Design System Made by <a href="https://creative-tim.com/" target="_blank">Creative Tim </a> . Check our latest Premium Bootstrap 5 UI Kit.

                                Designed for those who like bold elements and beautiful websites. Made of hundred of elements, designed blocks and fully coded pages, Material Kit is ready to help you create stunning websites and webapps.
                            </p>
                            <div class="github-buttons">
                                <a href="https://www.creative-tim.com/product/material-kit-pro?ref=index-mk2" target="_blank" class="btn bg-gradient-primary mb-5 mb-sm-0">Upgrade to Pro</a>
                                <div class="github-button">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-12 my-auto">
                            <a href="https://www.creative-tim.com/product/material-kit-pro?ref=index-mk2">
                                <img class="w-100 border-radius-lg shadow-lg" src="https://s3.amazonaws.com/creativetim_bucket/products/46/original/material-kit-pro.jpg?1632843641" alt="Product Image">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    @include('site.prefooter')

    </section>
    </div>

    @include('site.footer')

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
