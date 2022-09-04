<?php

namespace App\Orchid\Layouts\AlfaCRM\Settings;

use App\Models\amoCRM\Field;
use App\Models\amoCRM\Status;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FieldsHelp extends \Orchid\Screen\Layouts\Table
{
    protected $target = 'fieldsAmoCRM';

    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Название'),
            TD::make('code', 'Код'),
            TD::make('field_id', 'ID'),
        ];
    }
}
