<section class="py-lg-5" name="contact-form">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card box-shadow-xl overflow-hidden mb-5">
                    <div class="row">
                        <div class="col-lg-5 position-relative bg-cover px-0" style="background-image: url({{asset('/site/img/shapes/waves-white.svg')}})" loading="lazy">
                            <div class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                <div class="mask bg-gradient-dark opacity-9"></div>
                                <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                    <h3 class="text-white">Контакты</h3>
                                    <p class="text-white opacity-8 mb-4">Или свяжитесь со мной, если вопрос срочный</p>
                                    <div class="d-flex p-2 text-white">
{{--                                        <div>--}}
{{--                                            <i class="fas fa-phone text-sm"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="ps-3">--}}
{{--                                            <span class="text-sm opacity-8">+7 (999) 637-39-55</span>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-envelope text-sm"></i>
                                            <a class=" text-white btn-lg mb-0" href="mailto:hello@blackclever.ru">hello@blackclever.ru</a>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                    </div>
                                    <div class="mt-4">
                                        <a  class="btn btn-icon-only btn-link text-white btn-lg mb-0" href="https://wapp.click/79996373955" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a class="btn btn-icon-only btn-link text-white btn-lg mb-0" href="https://t.me/blackcleverBot" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fab fa-telegram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form class="p-3" id="contact-form" method="post">
                                <div class="card-header px-4 py-sm-5 py-3">
                                    <h2>Оставьте заявку</h2>
{{--                                    <p class="lead">И мы свяжемся с вами</p>--}}
                                </div>
                                {{ csrf_field() }}
                                <div class="card-body pt-1">
                                    <div class="row">
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Имя</label>
                                                <input type="text" name="name" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Телефон</label>
                                                <input type="text" name="phone" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pe-2 mb-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Сообщение</label>
                                                <label for="message"></label>
                                                <textarea name="message" class="form-control" id="message" rows="6" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="github-buttons">
                                            <button type="submit" formaction="{{ route('form') }}" class="btn bg-gradient-primary mb-5 mb-sm-0">Отправить</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

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
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
