<?php

namespace App\Orchid\Layouts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class BizonConnectToken extends Rows
{
    public $account;
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Label::make('label')
                ->title('Токен')
                ->popover('Из кабинета Бизон365'),
            
            Input::make('token')
                ->value(Auth::user()->account->token_bizon)
                ->required(true),//TODO size
            
            Button::make('Сохранить')
                ->method('save')
                ->type(Color::PRIMARY()),
        ];
    }
}
