<?php

namespace App\Orchid\Layouts\Bizon;

use App\Models\amoCRM\Field;
use App\Models\amoCRM\Staff;
use App\Models\amoCRM\Status;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class Staffs extends \Orchid\Screen\Layouts\Table
{

    protected $target = 'staffs';

    protected function columns(): iterable
    {
        return [
            TD::make('staff_id', 'ID'),
            TD::make('name', 'Имя'),
        ];
    }

    protected function textNotFound(): string
    {
        return 'Информации нет, обновите сотрудников';
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return 'Нажмите на кнопку выше \'Пользователи amoCRM\'';
    }
}
