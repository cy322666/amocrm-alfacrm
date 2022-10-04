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
                            <span class="badge bg-primary mb-3">CLEVER PLATFORM</span>
                            <h2 class="text-white mb-0">Платформа готовых решений</h2>
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
            </div>
        </section>

        @include('site.prefooter')

    </div>

    @include('site.scripts')

    @include('site.footer')

</body>
</html>
