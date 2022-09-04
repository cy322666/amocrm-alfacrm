<?php

namespace App\Orchid\Layouts\AlfaCRM\Settings;

use App\Models\amoCRM\Field;
use App\Models\amoCRM\Pipeline;
use App\Models\amoCRM\Status;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Color;

class StatusFields extends \Orchid\Screen\Layouts\Rows
{

    /**
     * @inheritDoc
     */
    protected function fields(): iterable
    {
        return [
            Input::make('setting.status_record_1')
                ->title('Этап записи')
                ->required()
                ->help('Этап на котором клиента записывают на пробное'),

            Input::make('setting.status_came_1')
                ->title('Этап посещения')
                ->required()
                ->help('Этап на который сделка передвигается при посещении пробного'),

            Input::make('setting.status_omission_1')
                ->title('Этап пропуска')
                ->required()
                ->help('Этап на который сделка передвигается при отмене/пропуске пробного'),
        ];
    }
}
