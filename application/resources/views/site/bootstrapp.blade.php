<script src={{ asset("site/js/core/popper.min.js") }}></script>
<script src={{ asset("site/js/core/bootstrap.min.js") }}></script>
<script src={{ asset("site/js/core/bootstrap.bundle.min.js") }}></script>

<script src={{ asset("site/js/plugins/perfect-scrollbar.min.js") }}></script>
<script src={{ asset("site/js/plugins/countup.min.js") }}></script>
<script src={{ asset("site/js/plugins/flatpickr.min.js") }}></script>
<script src={{ asset("site/js/plugins/choices.min.js") }}></script>
<script src={{ asset("site/js/plugins/prism.min.js") }}></script>
<script src={{ asset("site/js/plugins/moment.min.js") }}></script>
<script src={{ asset("site/js/plugins/highlight.min.js") }}></script>
<script src={{ asset("site/js/plugins/rellax.min.js") }}></script>
<script src={{ asset("site/js/plugins/typedjs.js") }}></script>
<script src={{ asset("site/js/plugins/tilt.min.js") }}></script>
<script src={{ asset("site/js/plugins/choices.min.js") }}></script>
<script src={{ asset("site/js/plugins/parallax.min.js") }}></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src={{ asset("site/js/material-kit.min.js?v=3.0.1") }} type="text/javascript"></script>
<script src={{ asset("site/js/material-kit.js") }} type="text/javascript"></script>

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<link href={{ asset("site/css/nucleo-icons.css") }} rel="stylesheet" />
<link href={{ asset("site/css/nucleo-svg.css") }} rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
<link href={{ asset("site/css/material-kit.css?v=3.0.1") }} rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

{{--<script type="text/javascript">--}}

{{--    if (document.getElementById('state1')) {--}}
{{--        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));--}}
{{--        if (!countUp.error) {--}}
{{--            countUp.start();--}}
{{--        } else {--}}
{{--            console.error(countUp.error);--}}
{{--        }--}}
{{--    }--}}
{{--    if (document.getElementById('state2')) {--}}
{{--        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));--}}
{{--        if (!countUp1.error) {--}}
{{--            countUp1.start();--}}
{{--        } else {--}}
{{--            console.error(countUp1.error);--}}
{{--        }--}}
{{--    }--}}
{{--    if (document.getElementById('state3')) {--}}
{{--        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));--}}
{{--        if (!countUp2.error) {--}}
{{--            countUp2.start();--}}
{{--        } else {--}}
{{--            console.error(countUp2.error);--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}

<script>
$('a[href^="#"').on('click', function() {

    let href = $(this).attr('href');

    $('html, body').animate({
        scrollTop: $(href).offset().top
    });
    return false;
});
</script>