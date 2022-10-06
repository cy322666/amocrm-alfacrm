<?php

namespace App\Orchid\Screens\GetCourse;

use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use App\Orchid\Layouts\Bizon\Staffs;
use Illuminate\Support\Facades\Auth;
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
    private $amoAccount;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $this->amoAccount   = Auth::user()->amoAccount();

        $setting = Auth::user()->getcourseSetting;

        return [
            'active'    => $setting->active,
            'staffs'    => $this->amoAccount->amoStaffs,
            'pipelines' => $this->amoAccount->amoPipelines,
            'setting'   => $setting,
            'statuses'  => $this->amoAccount
                ->amoStatuses()
                ->where('name', '!=', 'Неразобранное')
                ->orderBy('id')
                ->get(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Настройки';
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
                        Input::make('status_id_form')
                            ->type('text')
                            ->title('Для новых заявок'),

                        Input::make('status_id_payment')
                            ->type('text')
                            ->title('Для новых оплат'),

                        Input::make('status_id_order')
                            ->type('text')
                            ->title('Для новых заказов'),

                        Input::make('status_id_order_close')
                            ->type('text')
                            ->title('Для оплаченных заказов'),
                    ]),
                    Statuses::class,
                ]),
                'Ответственные' => Layout::columns([

                    Layout::rows([
                        Input::make('response_user_id_default')
                            ->type('numeric')
                            ->title('По умолчанию'),

                        Input::make('response_user_id_form')
                            ->type('numeric')
                            ->title('Для новых заявок'),

                        Input::make('response_user_id_payment')
                            ->type('numeric')
                            ->title('Для новых платежей'),

                        Input::make('response_user_id_order')
                            ->type('numeric')
                            ->title('Для новых заказов'),
                    ]),
                    Staffs::class,
                ]),

                'Вебхуки' => [
                    Layout::rows([
                        Label::make('wh1')
                            ->title('Хук для заявок с форм'),
//                            ->value(URL::route($this->whStatusCame->path, [
//                                'webhook' => $this->whStatusCame->uuid,
//                            ])),
                        Label::make('wh2')
                            ->title('Хук для заказов'),
//                            ->value(URL::route($this->whStatusOmission->path, [
//                                'webhook' => $this->whStatusOmission->uuid,
//                            ])),
                        Label::make('wh2')
                            ->title('Хук для оплат'),
//                            ->value(URL::route($this->whStatusOmission->path, [
//                                'webhook' => $this->whStatusOmission->uuid,
//                            ])),
                    ]),
                ],
            ]),
        ];
    }
}
