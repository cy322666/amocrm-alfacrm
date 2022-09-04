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

class Statuses extends \Orchid\Screen\Layouts\Table
{

    protected $target = 'statuses';

    /**
     * @inheritDoc
     */
//    protected function fields(): iterable
//    {
//        Layout::table('statuses', [


//        ]);
//        $pipelines = Auth::user()->account->pipelines;
//
//        foreach ($pipelines as $pipeline) {
//
//
//        }

//        return [
//
//        ];
//    }

//    private function prepare($pipeline)
//    {
//        Label::make('static')
//            ->title('Static:')
//            ->value('email@example.com');
//
//        foreach ($pipeline->statuses as $status) {
//
//
//        }
//    }

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->align('center')
                ->width('220')
                ->render(function (Status $model) {

                    return '<div class="filled-circle" style="background-color: '.$model->color.'; border-radius: 20px">'.$model->status_id.'</div>';
                }),

            TD::make('name', 'Статус')
//                ->width('250')
                ->render(function (Status $model) {

                    return $model->name;
                }),

//            TD::make('id', 'ID воронки')
//                ->width('150')
//                ->render(function (Status $model) {
//                    return $model->pipeline->pipeline_id;
//                }),

            TD::make('name', 'Воронка')
                ->width('450')
                ->render(function (Status $model) {
                    return $model->pipeline->name;
                }),
            ];
    }
}
