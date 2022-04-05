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

<div class="form-check form-switch d-flex align-items-center mb-2">
    <input type="hidden" name="remember">
    <input type="checkbox" name="remember" value="true" class="form-check-input" {{ !old('remember') || old('remember') === 'true'  ? 'checked' : '' }}>
    <label class="form-check-label mb-0 ms-3" for="rememberMe">Запомнить меня</label>
</div>

<div class="text-center">
    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Войти</button>
</div>

<p class="mt-4 text-sm text-center">Нет аккаунта?</p>