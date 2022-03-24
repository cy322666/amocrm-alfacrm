<?php

namespace App\Orchid\Layouts;

use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class BizonConnectInfo extends Rows
{
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
            Label::make('label')->title('Произведите настройку'),
    
            Link::make('Перейти')
                ->route('bizon.setting.index')
                ->icon('control-play'),
        ];
    }
}
