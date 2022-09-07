<?php

namespace App\Orchid\Layouts\AlfaCRM\Settings;

use App\Models\AlfaCRM\LeadStatus;
use Orchid\Screen\TD;

class Stages extends \Orchid\Screen\Layouts\Table
{

    protected $target = 'stages';

    protected function columns(): iterable
    {
        return [
            TD::make('status_id', 'ID'),

            TD::make('name', 'Статус'),

            TD::make('is_enabled', 'Активный')
                ->render(function (LeadStatus $model) {
                    return $model->is_enabled == true ? 'Да' : 'Нет';
                }),
            ];
    }
}
