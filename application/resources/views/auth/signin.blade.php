<div class="input-group input-group-outline my-3" style="display: contents;">
{{--    <label class="form-label"></label>--}}
        {!!  \App\Models\Orchid\EmailField::make('email')
                ->type('email')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Ведите почту'))
                ->style('margin-bottom: 15px')
        !!}
</div>

<div class="input-group input-group-outline mb-3" style="display: contents;">
{{--    <label class="form-label" style="margin: 10px"></label>--}}
        {!!  \App\Models\Orchid\PasswordField::make('password')
            ->required()
            ->tabindex(2)
            ->placeholder(__('Введите пароль'))
            ->style('margin-bottom: 20px')
        !!}
</div>
<div class="form-check form-switch d-flex align-items-center mb-2">
    <input type="hidden" name="remember">
    <input type="checkbox" name="remember" value="true" class="form-check-input" {{ !old('remember') || old('remember') === 'true'  ? 'checked' : '' }}>
    <label class="form-check-label mb-0 ms-3" for="rememberMe">Запомнить меня</label>
</div>

<div class="text-center">
    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-3">Войти</button>
    <a class="btn btn-link" href="{{ route('auth.signup') }}">
        {{ __('Нет аккаунта?') }}
    </a>
</div>