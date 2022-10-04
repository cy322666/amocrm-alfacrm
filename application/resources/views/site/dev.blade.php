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

    <section class="py-5">

        @include('site.prefooter')

    </section>
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
