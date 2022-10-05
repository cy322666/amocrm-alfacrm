<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<script src={{ asset("site/js/core/popper.min.js") }}></script>
<script src={{ asset("site/js/core/bootstrap.min.js") }}></script>
{{--<script src={{ asset("site/js/core/bootstrap.bundle.min.js") }}></script>--}}

<script src={{ asset("site/js/plugins/flatpickr.min.js") }}></script>
<script src={{ asset("site/js/plugins/prism.min.js") }}></script>
<script src={{ asset("site/js/plugins/moment.min.js") }}></script>
<script src={{ asset("site/js/plugins/highlight.min.js") }}></script>
<script src={{ asset("site/js/plugins/typedjs.js") }}></script>


<script src={{ asset("site/js/plugins/perfect-scrollbar.min.js") }}></script>
<script src={{ asset("site/js/plugins/countup.min.js") }}></script>
<script src={{ asset("site/js/plugins/rellax.min.js") }}></script>
<script src={{ asset("site/js/plugins/tilt.min.js") }}></script>
<script src={{ asset("site/js/plugins/choices.min.js") }}></script>
<script src={{ asset("site/js/plugins/parallax.min.js") }}></script>

<script src={{ asset("site/js/material-kit.js?v=3.0.4") }} type="text/javascript"></script>

<script type="text/javascript">
    if (document.getElementById('state1')) {
        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('state2')) {
        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('state3')) {
        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }
</script>

{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>--}}
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
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/90370781" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
</script>

{{--    amochat   --}}
<script>
    (function(a,m,o,c,r,m){a[m]={id:"290181",hash:"d0b625ed48b9390dbeca8ed9ac0b8f1e771dd8be82080abcbc7f4fa429ca7749",locale:"ru",inline:false,setMeta:function(p){this.params=(this.params||[]).concat([p])}};a[o]=a[o]||function(){(a[o].q=a[o].q||[]).push(arguments)};var d=a.document,s=d.createElement('script');s.async=true;s.id=m+'_script';s.src='https://gso.amocrm.ru/js/button.js?1663159216';d.head&&d.head.appendChild(s)}(window,0,'amoSocialButton',0,0,'amo_social_button'));
</script>

