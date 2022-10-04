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
                        <h1 class="text-gradient text-primary"><span id="state1" countTo="70">200</span>+</h1>
                        <h5 class="mt-3">Проектов</h5>
                        <p class="text-sm font-weight-normal">Проектов внедрения/сопровождения/разработки для наших клиентов, использующих amoCRM</p>
                    </div>
                    <hr class="vertical dark">
                </div>
                <div class="col-md-4 position-relative">
                    <div class="p-3 text-center">
                        <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">4 из 5</span></h1>
                        <h5 class="mt-3">Клиентов</h5>
                        <p class="text-sm font-weight-normal">Остается сотрудничать с нами после завершения основного проекта</p>
                    </div>
                    <hr class="vertical dark">
                </div>
                <div class="col-md-4">
                    <div class="p-3 text-center">
                        <h1 class="text-gradient text-primary" id="state3" countTo="4">5+</h1>
                        <h5 class="mt-3">Лет на рынке</h5>
                        <p class="text-sm font-weight-normal">Прошли долгий путь вместе с замечательным продуктом amoCRM</p>
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

{{--    @include('site.footer')--}}

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(90370781, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/90370781" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

{{--    amochat   --}}
<script>
    (function(a,m,o,c,r,m){a[m]={id:"290181",hash:"d0b625ed48b9390dbeca8ed9ac0b8f1e771dd8be82080abcbc7f4fa429ca7749",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js?1663159216';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));
</script>
</body>

</html>
