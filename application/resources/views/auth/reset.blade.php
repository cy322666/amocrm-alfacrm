@extends('auth.core')
@section('title',__('Регистрация'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Восстановить')}}</h1>

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
                <x-orchid-icon path="login" class="small me-2"/>
                {{__('Зарегистрироваться')}}
            </button>
        </div>
    </form>
@endsection
