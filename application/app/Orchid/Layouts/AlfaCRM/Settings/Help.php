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

class Help extends \Orchid\Screen\Layouts\Rows
{

    /**
     * @inheritDoc
     */
    protected function fields(): iterable
    {
        return [

            Input::make('responsible')
                ->options([])
                ->title('Ответственный')
                ->empty('Не выбрано'),

            //TODO branch
        ];
    }
}
