<div class="input-group input-group-outline my-3" style="margin-left: 6rem;">

    <span class="thumb-sm avatar me-3">
        <img src="{{ $lockUser->presenter()->image() }}" class="b bg-light" alt="test">
    </span>
    <span style="font-size: 0.95em;">
        <span class="text-ellipsis">{{ $lockUser->presenter()->title() }}</span>
        <span class="text-muted d-block text-ellipsis">{{ $lockUser->presenter()->subTitle() }}</span>
    </span>
    <input type="hidden" name="email" required value="{{ $lockUser->email }}">
</div>

@error('email')
    <span class="d-block invalid-feedback text-danger">
            {{ $errors->first('email') }}
    </span>
@enderror

<div class="input-group input-group-outline mb-3">
{{--    <div class="mb-3 col-md-6 col-xs-12">--}}
{{--        <a href="{{ route('auth.login') }}" class="small">--}}
{{--            {{__('Войдите в ваш аккаунт')}}--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <input type="hidden" name="remember" value="true">--}}

    {!!  \App\Models\Orchid\PasswordField::make('password')
            ->required()
            ->tabindex(1)
            ->autofocus()
            ->placeholder(__('Введите пароль'))
    !!}
</div>

<div class="row">
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Войти</button>
    </div>
{{--    {{--            <button id="button-login" type="button" onclick="window.location='{{ route('auth.drop') }}'" class="btn bg-gradient-primary w-100 my-3 mb-2" tabindex="2" formaction="{{ route('auth.signup') }}">--}}
    {{--                Войти--}}
    {{--            </button>--}}
    <p class="mt-4 text-sm text-center">Есть другой аккаунт?</p>
</div>