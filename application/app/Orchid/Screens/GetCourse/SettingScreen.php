<?php

namespace App\Orchid\Screens\GetCourse;

use App\Models\Account;
use App\Models\amoCRM\Pipeline;
use App\Models\amoCRM\Staff;
use App\Models\GetCourse\Setting;
use App\Models\Webhook;
use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use App\Orchid\Layouts\Bizon\Staffs;
use App\Services\amoCRM\Client as amoApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SettingScreen extends Screen
{
    private Account $amoAccount;
    private amoApi $amoApi;
    private Setting $setting;

    public Webhook $whForm;
    public Webhook $whOrder;

    public function query(): iterable
    {
        $this->amoAccount   = Auth::user()->amoAccount();

        $this->setting = Auth::user()->getcourseSetting;

        $this->amoApi = (new AmoApi($this->amoAccount));
        $this->amoApi->init();

        if ($this->amoApi->auth == false) {

            Alert::error('Ошибка подключения amoCRM');
        }

        return [
            'setting'   => $this->setting,
            'staffs'    => $this->amoAccount->amoStaffs,
            'pipelines' => $this->amoAccount->amoPipelines,
            'statuses'  => $this->amoAccount
                ->amoStatuses()
                ->where('name', '!=', 'Неразобранное')
                ->orderBy('id')
                ->get(),
            'whForm' => Auth::user()
                ->webhooks()
                ->where('app_id', 3)
                ->where('type', 'status_form')
                ->first(),
            'whOrder'   => Auth::user()
                ->webhooks()
                ->where('app_id', 3)
                ->where('type', 'status_order')
                ->first(),
        ];
    }

    public function name(): ?string
    {
        return 'Настройки';
    }

    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Задать вопрос')
                ->method('questionSave')
                ->modal('question')
                ->icon('globe-alt'),

            Link::make('Инструкция')
                ->icon('docs')
                ->href(''),//TODO

            ModalToggle::make('Обратная связь')
                ->method('feedbackSave')
                ->modal('feedback')
                ->icon('social-github'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(Layout::rows([

                RadioButtons::make('setting.active')
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
                        Input::make('setting.status_id_form')
                            ->type('text')
                            ->title('Для новых заявок'),

                        Input::make('setting.status_id_order')
                            ->type('text')
                            ->title('Для новых заказов'),

                        Input::make('setting.status_id_order_close')
                            ->type('text')
                            ->title('Для оплаченных заказов'),
                    ]),
                    Statuses::class,
                ]),
                'Ответственные' => Layout::columns([

                    Layout::rows([
                        Input::make('setting.response_user_id_default')
                            ->type('numeric')
                            ->title('По умолчанию'),

                        Input::make('setting.response_user_id_form')
                            ->type('numeric')
                            ->title('Для новых заявок'),

                        Input::make('setting.response_user_id_order')
                            ->type('numeric')
                            ->title('Для новых заказов'),
                    ]),
                    Staffs::class,
                ]),

                'Вебхуки' => [
                    Layout::rows([
                        Label::make('wfForm')
                            ->title('Хук для заявок с форм')
                            ->value(
                                URL::route($this->whForm->path, [
                                    'webhook' => $this->whForm->uuid
                                ]).$this->whForm->params
                            ),
                        Label::make('wfOrders')
                            ->title('Хук для заказов')
                            ->value(
                                URL::route($this->whOrder->path, [
                                    'webhook' => $this->whOrder->uuid,
                                ]).$this->whOrder->params
                            ),
                    ]),
                ],
            ]),
        ];
    }

    public function updateStatuses()
    {
        try {
            Pipeline::updateStatuses($this->amoApi, $this->amoAccount);

            Toast::success('Успешно обновлено');

        } catch (\Exception $exception) {

            $this->setting->active = false;
            $this->setting->save();

            Alert::error('Ошибка обновления');

            Log::error(__METHOD__.' : '.Auth::user()->email.' '.$exception->getMessage());
        }
    }

    public function updateStaffs(Request $request)
    {
        try {
            Staff::updateStaffs($this->amoApi, $this->amoAccount);

            Toast::success($request->get('toast', 'Успешно'));

        } catch (\Exception $exception) {

            Toast::error($request->get('toast', 'Произошла ошибка'));

            Log::channel('getcourse')->error(Auth::user()->email.' '.$exception->getMessage());
        }
    }

    public function save(Request $request)
    {
        try {
            $this->setting->fill($request->toArray()['setting']);
            $this->setting->save();

            Toast::success($request->get('toast', 'Успешно сохранено'));

        } catch (\Throwable $exception) {

            Toast::error($request->get('toast', 'Произошла ошибка при сохранении'));

            Log::channel('getcourse')->error(Auth::user()->email.' '.$exception->getMessage());
        }
    }
}
