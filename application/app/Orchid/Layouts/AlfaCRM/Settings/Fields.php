<?php

namespace App\Orchid\Layouts\AlfaCRM\Settings;

use App\Models\amoCRM\Field;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class Fields extends \Orchid\Screen\Layouts\Rows
{

    /**
     * @inheritDoc
     */
    protected function fields(): iterable
    {
        //TODO снести?
        return [
            Input::make('fields.name')
                ->title('Полное имя')
                ->required(),

//            Select::make('fields.source')
//                ->options($fields)
//                ->title('Источник'),

//            Select::make('responsible')
//                ->options($fields)
//                ->title('Ответственный')
//                ->empty('Не выбрано'),

//            Input::make('legal_name')
//                ->required()
//                ->title('Имя заказчика'),
//
//            Input::make('dob')
//                ->title('Дата рождения'),
//
//            Input::make('note')
//                ->title('Примечание'),
//
//            Input::make('email')
//                ->title('Почта')
//                ->required(),
//
//            Input::make('phone')
//                ->required()
//                ->title('Телефон'),
//
//            Input::make('web')
//                ->title('Сайт'),
        ];
    }
}
