<header class="header-2">
    <div class="page-header min-vh-75 relative" style="background-image: url({{asset('site/img/8.jpeg')}})">
        <div class="container">

            <div class="row text-start pt-7">
                <div class="col-lg-6 pt-3 my-3">
                    <h1 class="text-black pt-2 mt-n5" style="font-size: 4rem; color: black; font-family: Arial">ЗАРАБАТЫВАЙТЕ БОЛЬШЕ</h1>
                    <p class="pt-3 mt-n5" style="font-size: 2rem; color: red; font-family: Arial" >Переведите свой бизнес из Excel в amoCRM</p>

                    <p class="lead text-black mt-3 col-lg-9">Исследуем Ваш бизнес, оцифровываем его и автоматизируем. Работа сотрудников становится прозрачнее и эффективнее, а конверсия возрастает в среднем на 40%</p>
                </div>

                <div class="card col-md-4 col-8 my-auto px-4 py-sm-3">
                    <div class="col-md-12 col-6 my-auto">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="input-group input-group-static mb-4">
                                <label>Имя</label>
                                <input type="text" name="name" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12 pe-2 mb-3">
                                <div class="input-group input-group-static mb-4">
                                    <label>Телефон</label>
                                    <input type="text" name="phone" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="github-buttons">
                                <button type="submit" formaction="{{ route('form') }}" class="btn bg-gradient-primary mb-5 mb-sm-0">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</header>
