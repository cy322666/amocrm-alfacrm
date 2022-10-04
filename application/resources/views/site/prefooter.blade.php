<section class="py-lg-5" name="contact-form">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card box-shadow-xl overflow-hidden mb-5">
                    <div class="row">
                        <div class="col-lg-5 position-relative bg-cover px-0">
                            <div class="z-index-2 text-center d-flex h-100 w-100 d-flex m-auto justify-content-center">
                                <div class="mask bg-gradient-dark opacity-9"></div>
                                <div class="p-5 ps-sm-8 position-relative text-start my-auto z-index-2">
                                    <h3 class="text-white">Контакты</h3>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-phone text-sm"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8">+7 (999) 637-39-55</span>
                                        </div>
                                    </div>
                                    <div class="d-flex p-2 text-white">
                                        <div>
                                            <i class="fas fa-envelope text-sm"></i>
                                        </div>
                                        <div class="ps-3">
                                            <span class="text-sm opacity-8">hello@blackclever.ru</span>
                                        </div>
                                    </div>
                                    <p>ИП Трофимов Вячеслав Михайлович</p>
                                    <p>ИНН: 025508490244</p>
                                    <div class="mt-2">
                                        <a  class="btn btn-icon-only btn-link text-white btn-lg mb-0" href="https://wapp.click/79996373955" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a class="btn btn-icon-only btn-link text-white btn-lg mb-0" href="https://t.me/blackcleverBot" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fab fa-telegram"></i>
                                        </a>
                                        <a class="btn btn-icon-only btn-link text-white btn-lg mb-0" href="https://www.youtube.com/channel/UC2V7MsEIfr44XsCrhnPD-gQ" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form class="p-3" id="contact-form" method="post">
                                <div class="card-header px-4 py-sm-5 py-3">
                                    <h2>Оставьте заявку</h2>
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

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

<link rel="icon" type="image/png" href={{ asset("favicon.png") }}>


{{--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>--}}
