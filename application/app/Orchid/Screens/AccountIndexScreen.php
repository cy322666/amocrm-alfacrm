<?php

namespace App\Orchid\Screens;

use App\Models\Api\Core\Account;
use App\Orchid\Layouts\ConnectAmoCRM;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class AccountIndexScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Аккаунт';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Аккаунт';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'user'    => Auth::user(),
            'account' => Auth::user()->account,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
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
                Sight::make('created_at', 'Создан'),
            ]),
            
            Layout::legend('account', [
                Sight::make('endpoint', 'Ключ для интеграциий'),
                Sight::make('referer', 'Полный адрес amoCRM'),
                Sight::make('status', 'Тариф')->render(function (Account $account) {
    
                    $account->getTarrif();
                }),
                Sight::make('token_bizon', 'Токен в Бизон 365'),
            ]),
            
            Layout::block(Layout::view('hello'))
                ->title('Подключение amoCRM')
                ->description('Подключите свою amoCRM к платформе'),//TODO под ним кнопка с инструкцией
//            Layout::legend('account', [
//                Sight::make('token_bizon', 'Токен в Бизон 365'),
//            ]),
        
        ];
    }
}
