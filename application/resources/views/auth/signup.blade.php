@extends('auth.core')
@section('title',__('Регистрация'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Регистрация')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-action="form#submit"
          data-form-button-animate="#button-login"
          data-form-button-text="{{ __('Загрузка...') }}"
          action="{{ route('auth.register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">
                {{__('Имя')}}
            </label>

            {!!  \Orchid\Screen\Fields\Input::make('name')
                ->type('text')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Введите ваше имя'))
            !!}
        </div>


        <div class="mb-3">
            <label class="form-label">
                {{__('Почта')}}
            </label>

            {!!  \Orchid\Screen\Fields\Input::make('email')
                ->type('email')
                //->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Введите вашу почту'))
            !!}
        </div>

        <div class="mb-3">

            <label class="form-label">
                {{__('Пароль')}}
            </label>

            {!!  \Orchid\Screen\Fields\Input::make('password')
                //->required()
                ->tabindex(2)
                ->placeholder(__('Введите пароль'))
            !!}
        </div>

            <div class="mb-3 col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
{{--                    <x-orchid-icon path="login" class="small me-2"/>--}}
                    Зарегистрироваться
                </button>
            </div>
    </form>

@endsection

@section('buttons')
    <div class="row">
        <div class="mb-3 col-md-6 col-xs-12">
            Есть аккаунт?
        </div>
        <div class="mb-3 col-md-6 col-xs-12">
            <button id="button-login" type="button" onclick="window.location='{{ route('auth.login') }}'" class="btn btn-default btn-block" tabindex="2">
                Войти
            </button>
        </div>
    </div>

{{--    <div class="row">--}}
{{--        <div class="mb-3 col-md-6 col-xs-12">--}}
{{--            Заблудились?--}}
{{--        </div>--}}
{{--        <div class="mb-3 col-md-6 col-xs-12">--}}
{{--            <button id="button-login" type="button" onclick="window.location='{{ route('platform.main') }}'" class="btn btn-default btn-block" tabindex="2" formaction="{{ route('auth.signup') }}">--}}
{{--                На главную--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
