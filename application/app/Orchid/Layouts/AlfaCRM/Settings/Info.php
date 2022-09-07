<?php

namespace App\Orchid\Layouts\AlfaCRM\Settings;

use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Support\Color;

class Info extends \Orchid\Screen\Layouts\Rows
{

    /**
     * @inheritDoc
     */
    protected function fields(): iterable
    {
        return [
            Input::make('account.code')
                ->title('API ключ')
                ->required()
                ->help('Ключ API (v2api) из AlfaCRM'),

            Input::make('account.subdomain')
                ->title('Название аккаунта')
                ->required()
                ->help('Название аккаунта AlfaCRM (перед .s20.online)'),

            Input::make('account.client_id')
                ->type('email')
                ->title('Email пользователя')
                ->help("Почта от администратора в AlfaCRM"),

            RadioButtons::make('setting.active')
                ->options([
                    true  => 'Включена',
//                    false => 'Выключена',
                    null  => 'Выключена',
                ])
                ->help('Статус интеграции'),

            CheckBox::make('setting.work_lead')
                ->title('Работа с лидами')
                ->sendTrueOrFalse()
                ->help('Если не выбрано, то создаются только клиенты'),
        ];
    }
}
