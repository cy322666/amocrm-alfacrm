<!DOCTYPE HTML>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

@include('site.bootstrap')

<body class="index-page bg-gray-200">

    @include('site.nav')

    @include('site.header')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

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
            </div>
        </section>

        <!-- Highlights -->
        <section id="highlights" class="wrapper style3">
            <div class="title">The Endorsements</div>
            <div class="container">
                <div class="row aln-center">
                    <div class="col-4 col-12-medium">
                        <section class="highlight">
                            <a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>
                            <h3><a href="#">Aliquam diam consequat</a></h3>
                            <p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
                            <ul class="actions">
                                <li><a href="#" class="button style1">Learn More</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-4 col-12-medium">
                        <section class="highlight">
                            <a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
                            <h3><a href="#">Nisl adipiscing sed lorem</a></h3>
                            <p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
                            <ul class="actions">
                                <li><a href="#" class="button style1">Learn More</a></li>
                            </ul>
                        </section>
                    </div>
                    <div class="col-4 col-12-medium">
                        <section class="highlight">
                            <a href="#" class="image featured"><img src="images/pic04.jpg" alt="" /></a>
                            <h3><a href="#">Mattis tempus lorem</a></h3>
                            <p>Eget mattis at, laoreet vel amet sed velit aliquam diam ante, dolor aliquet sit amet vulputate mattis amet laoreet lorem.</p>
                            <ul class="actions">
                                <li><a href="#" class="button style1">Learn More</a></li>
                            </ul>
                        </section>
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
