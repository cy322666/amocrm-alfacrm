<?php

namespace App\Orchid\Screens;

//use App\Models\Orchid\amoCRMButton;
//use App\Orchid\Layouts\ConnectAmoCRM;
use App\Models\User;
use App\Orchid\Buttons\amoCRMButton;
use App\Orchid\Layouts\AlfaCRM\Settings\FieldsAlfaCRM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Label;
use Throwable;

class AccountIndexScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public string $name = 'Аккаунт';

    public bool $authActive;

    public ?bool $auth;

    /**
     * Display header description.
     *
     * @var string|null
     */
    public ?string $description = 'Основная информация';

    /**
     * Query data.
     *
     * @param Request $request
     * @return array
     */
    public function query(Request $request): array
    {
        return [
            'user' => Auth::user(),
            'auth' => $request->auth,
            'authActive' => Auth::user()->amoAccount()->active,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return array
     * @throws Throwable
     */
    public function layout(): array
    {
        return [
            Layout::legend('user', [
                Sight::make('name', 'Имя'),
                Sight::make('email', 'Почта'),
                Sight::make('created_at', 'Создан')
                    ->render(function ($user) {
                        return Carbon::parse($user->created_at)
                            ->format('Y-m-d H:i:s');
                    }),
                Sight::make('authActive', 'Подключение amoCRM')->render(function () {
                    return $this->authActive == false
                        ? '<i class="text-danger">●</i> Не подключено'
                        : '<i class="text-success">●</i> Подключено';
                }),
            ]),
            Layout::block([
                    Layout::rows([
                        Label::make('label')->title('Если кнопка не отображается обновите страницу'),
                        amoCRMButton::make('button.auth'),
                ]),
            ])
            ->title('Подключите amoCRM к платформе'),
        ];
    }
}
