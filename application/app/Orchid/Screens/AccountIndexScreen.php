<?php

namespace App\Orchid\Screens;

//use App\Models\Orchid\amoCRMButton;
//use App\Orchid\Layouts\ConnectAmoCRM;
use App\Models\User;
use App\Orchid\Buttons\amoCRMButton;
use App\Orchid\Layouts\AlfaCRM\Settings\FieldsHelp;
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
use Throwable;

class AccountIndexScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public string $name = 'Аккаунт';

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
            'user' => User::query()->first(),
           // 'account' => Auth::user()->account,
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
//                Sight::make('email_verified_at', 'Почта подтверждена')->render(function (User $user) {
//                    return $user->email_verified_at === null
//                        ? '<i class="text-danger">●</i> Нет'
//                        : '<i class="text-success">●</i> Да';
//                }),
                Sight::make('created_at', 'Создан')
                    ->render(function ($user) {
                        return Carbon::parse($user->created_at)
                            ->format('Y-m-d H:i:s');
                    })
            ]),
            Layout::block([
//                'Поля' => Layout::columns([

                    Layout::rows([

                        amoCRMButton::make('name'),//->title('Подключите amoCRM'),

//                        Button::make('Сохранить')
//                            ->method('save')
//                            ->type(Color::DEFAULT()),
//                    ])),
                ]),
            ])
            ->title('Статус интеграции')
            ->description('Проверьте все настройки'),
        ];
    }
//            Layout::legend('account', [
//                Sight::make('endpoint', 'Ключ для интеграциий'),
//                Sight::make('referer', 'Полный адрес amoCRM'),
////                Sight::make('status', 'Тариф')->render(function (Account $account) {
//
////                    $account->getTarrif();
////                }),
////                Sight::make('token_bizon', 'Токен в Бизон 365'),
//            ]),

//            Layout::rows([
//

}
