<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="{{ route('site') }}" rel="tooltip" title="Black Clever" data-placement="bottom">
                        BLACK CLEVER
                    </a>

                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon mt-2"></span>
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>

                    </button>

                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                    <ul class="navbar-nav navbar-nav-hover ms-auto">
                        <li class="nav-item dropdown dropdown-hover mx-2">
                            <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" href="{{ route('site') }}">
                                <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                amoCRM
                            </a>

                        <li class="nav-item dropdown dropdown-hover mx-2">
                            <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" href="{{ route('dev') }}">
                                <i class="material-icons opacity-6 me-2 text-md">view_day</i>
                                Разработка
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-hover mx-2">
                            <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" href="{{ route('widgets') }}">
                                <i class="material-icons opacity-6 me-2 text-md">article</i>
                                Платформа
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">
                                <div class="d-none d-lg-block">
                                    <ul class="list-group">
                                        <li class="nav-item list-group-item border-0 p-0">
                                            <a class="dropdown-item py-2 ps-3 border-radius-md" href="{{ route('auth.login') }}">
                                                <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Вход</h6>
                                                <span class="text-sm">Войти в платформу</span>
                                            </a>
                                        </li>
                                        <li class="nav-item list-group-item border-0 p-0">
                                            <a class="dropdown-item py-2 ps-3 border-radius-md" href="{{ route("auth.signup") }}">
                                                <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Регистрация</h6>
                                                <span class="text-sm">Регистрация в платформе</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item my-auto ms-3 ms-lg-0">
                            <a href="#contact-form" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Связаться</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
