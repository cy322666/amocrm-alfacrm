<?php

namespace App\Orchid\Screens\GetCourse;

use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use Illuminate\Support\Facades\URL;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class SettingScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'SettingScreen';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Задать вопрос')
                ->method('questionSave')
                ->modal('question')
                ->icon('globe-alt'),

            Link::make('Инструкция')
                ->icon('docs')
                ->href('https://www.youtube.com/watch?v=kUdNZeGh1jY'),//TODO

            ModalToggle::make('Обратная связь')
                ->method('feedbackSave')
                ->modal('feedback')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            Layout::block(Layout::rows([

                RadioButtons::make('active')
                    ->options([
                        true  => 'Включена',
                        null  => 'Выключена',
                    ])
                    ->help('Статус интеграции'),
            ]))
                ->title('Статус интеграции')
                ->description('Проверьте все настройки'),

            Layout::block(Layout::rows([
                Group::make([

                    Button::make('Статусы amoCRM')
                        ->method('updateStatuses')
                        ->type(Color::DEFAULT()),

                    Button::make('Пользователи amoCRM')
                        ->method('updateStaffs')
                        ->type(Color::DEFAULT()),

                ])->autoWidth()
            ]))
                ->title('Обновить данные')
                ->description('Если нужно обновить данные систем, то нажмите нужную кнопку'),

            Layout::block(Layout::rows([
                Group::make([
                    Button::make('Сохранить')
                        ->method('save')
                        ->type(Color::INFO()),

                    Button::make('Сбросить')
                        ->method('reset')
                        ->type(Color::WARNING()),
                ])->autoWidth()
            ])),

            Layout::tabs([
                'Статусы' => Layout::columns([
                    Layout::rows([
                    ]),
                ]),
                'Ответственные' => Layout::columns([

                    Layout::rows([
                        Input::make('staffDefault')
                            ->type('text')
                            ->title('По умолчанию')
                            ->value($this->setting->staff_id_default ?? ''),

                        Input::make('staffCold')
                            ->type('text')
                            ->title('Для Холодных')
                            ->value($this->setting->staff_id_cold ?? ''),

                        Input::make('staffSoft')
                            ->type('text')
                            ->title('Для Теплых')
                            ->value($this->setting->staff_id_soft ?? ''),

                        Input::make('staffHot')
                            ->type('text')
                            ->title('Для Горячих')
                            ->value($this->setting->staff_id_hot ?? ''),

//                        Staffs::class,
                    ]),
                ]),
            ]),
        ];
    }
}
