@include('auth.head')

    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Войдите в аккаунт</h4>
                        <div class="row mt-4"></div>
                    </div>
                </div>
                <div class="card-body">

                    <form class="text-start"
                          role="form"
                          method="POST"
                          data-controller="form"
                          data-action="form#submit"
                          data-form-button-animate="#button-login"
                          data-form-button-text="{{ __('Загрузка...') }}"
                          action="{{ route('login.auth') }}">

                            @includeWhen($isLockUser,'auth.lockme')
                            @includeWhen(!$isLockUser,'auth.signin')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('auth.footer')

</div>
</body>
</html>