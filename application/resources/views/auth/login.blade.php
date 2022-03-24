@extends('auth.core')
@section('title',__('Вход'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Войдите в свой аккаунт')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="form"
          data-action="form#submit"
          data-form-button-animate="#button-login"
          data-form-button-text="{{ __('Загрузка...') }}"
          action="{{ route('auth.check') }}">
        @csrf

        @includeWhen($isLockUser,'auth.lockme')
        @includeWhen(!$isLockUser,'auth.signin')

    </form>
@endsection

@section('buttons')

{{--    <div class="row">--}}
{{--        <div class="mb-3 col-md-6 col-xs-12">--}}
{{--            Забыли пароль?--}}
{{--        </div>--}}
{{--        <div class="mb-3 col-md-6 col-xs-12">--}}
{{--            <button id="button-login" type="button" onclick="window.location='{{ route('auth.reset') }}'" class="btn btn-default btn-block" tabindex="2">--}}
{{--                Восстановить--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="mb-3 col-md-6 col-xs-12">
            Нет аккаунта?
        </div>
        <div class="mb-3 col-md-6 col-xs-12">
            <button id="button-login" type="button" onclick="window.location='{{ route('auth.signup') }}'" class="btn btn-default btn-block" tabindex="2" formaction="{{ route('auth.signup') }}">
                Регистрация
            </button>
        </div>
    </div>
<div class="row">
    <div class="mb-3 col-md-6 col-xs-12">
        Есть другой аккаунт?
    </div>
    <div class="mb-3 col-md-6 col-xs-12">
        <button id="button-login" type="button" onclick="window.location='{{ route('auth.drop') }}'" class="btn btn-default btn-block" tabindex="2" formaction="{{ route('auth.signup') }}">
            Войти
        </button>
    </div>
</div>

@endsection
