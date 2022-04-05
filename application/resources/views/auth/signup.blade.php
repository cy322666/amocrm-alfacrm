@include('auth.head')

<div class="row">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
        <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Регистрация</h4>
                    <div class="row mt-4"></div>
                </div>
            </div>
            <div class="card-body">

            <form class="m-t-md"
                  role="form"
                  method="POST"
                  data-controller="form"
                  data-action="form#submit"
                  data-form-button-animate="#button-login"
                  data-form-button-text="{{ __('Загрузка...') }}"
                  action="{{ route('auth.register') }}">

            <div class="input-group input-group-outline my-3">
                <label class="form-label"></label>
                {!!  \App\Models\Orchid\TextField::make('name')
                    ->type('text')
                    ->required()
                    ->tabindex(1)
                    ->autofocus()
                    ->placeholder(__('Введите имя'))
                !!}
            </div>

            <div class="input-group input-group-outline my-3">
                <label class="form-label"></label>
                {!!  \App\Models\Orchid\EmailField::make('email')
                        ->type('email')
                        ->required()
                        ->tabindex(1)
                        ->autofocus()
                        ->placeholder(__('Ведите почту'))
                !!}
            </div>

            <div class="input-group input-group-outline mb-3">
                <label class="form-label"></label>
                {!!  \App\Models\Orchid\PasswordField::make('password')
                    ->required()
                    ->tabindex(2)
                    ->placeholder(__('Введите пароль'))
                !!}
            </div>

            <div class="row">
                <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Отправить</button>
                </div>
                <p class="mt-4 text-sm text-center">Есть аккаунт?</p>
            </div>


