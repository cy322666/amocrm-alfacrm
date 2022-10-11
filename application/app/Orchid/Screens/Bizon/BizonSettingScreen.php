<?php

namespace App\Orchid\Screens\Bizon;

use App\Models\amoCRM\Pipeline;
use App\Models\amoCRM\Staff;
use App\Models\amoCRM\Status;
use App\Models\Account;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Webhook;
use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use App\Orchid\Layouts\Bizon\Staffs;
use App\Orchid\Screens\ScreenHelper;
use App\Services\amoCRM\Client;
use App\Services\amoCRM\Client as amoApi;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BizonSettingScreen extends Screen
{
    public AmoApi $amoApi;
    public $setting;
    public Account $amoAccount;
    public Account $bizonAccount;
    public ?Webhook $webhook;

    public $name = 'Настройки';

    public $description = '';

    public function query(): array
    {
        $this->amoAccount   = Auth::user()->amoAccount();
        $this->bizonAccount = Auth::user()->bizonAccount();

        $setting = Auth::user()->bizonSetting;

        $this->amoApi = (new AmoApi($this->amoAccount));
        $this->amoApi->init();

        if ($this->amoApi->auth == false) {

            Alert::error('Ошибка подключения amoCRM');
        }

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

            'webhook' => $setting->webhooks()->first()
        ];
    }

    public function commandBar(): array
    {
        return [
            ModalToggle::make('Задать вопрос')
                ->method('questionSave')
                ->modal('question')
                ->icon('globe-alt'),

            Link::make('Инструкция')
                ->icon('docs')
                ->href('https://www.youtube.com/watch?v=kUdNZeGh1jY'),

            ModalToggle::make('Обратная связь')
                ->method('feedbackSave')
                ->modal('feedback')
                ->icon('social-github'),
        ];
    }

    public function layout(): array
    {
        $status_id_cold = $this->setting->status_id_cold;
        $status_id_soft = $this->setting->status_id_soft;
        $status_id_hot  = $this->setting->status_id_hot;

        $tag_cold = $this->setting->tag_cold ?? 'Холодный';
        $tag_soft = $this->setting->tag_soft ?? 'Теплый';
        $tag_hot  = $this->setting->tag_hot ?? 'Горячий';
        $tag      = $this->setting->tag ?? 'Бизон';

        $time_cold = $this->setting->time_cold ?? 30;
        $time_soft = $this->setting->time_soft ?? 60;
        $time_hot  = $this->setting->time_hot ?? 90;

        return [

            Layout::block(Layout::rows([

                Input::make('token')
                    ->title('Токен Бизон365')
                    ->value($this->bizonAccount->access_token),

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
                Label::make('webhookLabel')
                    ->title('Хук о посещении пробного')
                    ->value(URL::route($this->webhook->path, [
                        'webhook' => $this->webhook->uuid,
                    ])),
                ])
            )
            ->title('Вебхук вебинаров')
            ->description('Добавьте webhook в кабинете Бизон 365'),

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

                'Сегментация' => Layout::columns([

                    Layout::rows([
                        Label::make('label_segment')
                            ->title('Сегменты по времени присутствия'),

                        Input::make('time_cold')
                            ->type('text')
                            ->title('Холодные')
                            ->value($time_cold)
                            ->popover('Зрители, которые присутствовали столько или менее этого значения'),

                        Input::make('time_soft')
                            ->type('text')
                            ->title('Теплые')
                            ->value($time_soft)
                            ->popover('Зрители, которые  присутствовали меньше этого значения, но больше Холодных'),

                        Input::make('time_hot')
                            ->type('text')
                            ->title('Горячие')
                            ->value($time_hot)
                            ->popover('Зрители, которые присутствовали столько и более этого значения'),
                    ]),

                    Layout::rows([
                        Label::make('label_tag')
                            ->title('Тегирование'),

                        Input::make('tag')
                            ->type('text')
                            ->title('Все')
                            ->value($tag)
                            ->popover('Будет добавляться во все сделки. Если не нужно, то оставьте пустым'),

                        Input::make('tag_cold')
                            ->type('text')
                            ->value($tag_cold)
                            ->title('Холодные')
                            ->popover('Будет добавляться в сделки Холодных клиентов. Если не нужно, то оставьте пустым'),

                        Input::make('tag_soft')
                            ->type('text')
                            ->title('Теплые')
                            ->value($tag_soft)
                            ->popover('Будет добавляться в сделки Теплых клиентов, то оставьте пустым'),

                        Input::make('tag_hot')
                            ->type('text')
                            ->title('Горячие')
                            ->value($tag_hot)
                            ->popover('Будет добавляться в сделки Горячих клиентов. Если не нужно, то оставьте пустым'),
                    ]),
                ]),

                'Статусы' => Layout::columns([
                    Layout::rows([
                        Input::make('status_id_cold')
                            ->type('text')
                            ->title('Холодные')
                            ->value($status_id_cold),

                        Input::make('status_id_soft')
                            ->type('text')
                            ->title('Теплые')
                            ->value($status_id_soft),

                        Input::make('status_id_hot')
                            ->type('text')
                            ->title('Горячие')
                            ->value($status_id_hot),
                    ]),
                    Statuses::class,
                ]),

                'Ответственные' => Layout::columns([

                    Layout::rows([
                        Input::make('staffDefault')
                            ->type('text')
                            ->title('По умолчанию')
                            ->value($this->setting->staff_id_default),

                        Input::make('staffCold')
                            ->type('text')
                            ->title('Для Холодных')
                            ->value($this->setting->staff_id_cold),

                        Input::make('staffSoft')
                            ->type('text')
                            ->title('Для Теплых')
                            ->value($this->setting->staff_id_soft),

                        Input::make('staffHot')
                            ->type('text')
                            ->title('Для Горячих')
                            ->value($this->setting->staff_id_hot),
                    ]),
                    Staffs::class,
                ]),
            ]),
        ];
    }

    public function save(Request $request)
    {
        try {
            $this->amoAccount   = Auth::user()->amoAccount();
            $this->bizonAccount = Auth::user()->bizonAccount();

            $this->bizonAccount->access_token = $request->token;

            if ($request->token)
                $this->active = true;

            $this->setting->time_cold = $request->time_cold;
            $this->setting->time_soft = $request->time_soft;
            $this->setting->time_hot  = $request->time_hot;
            $this->setting->tag       = $request->tag;
            $this->setting->tag_cold  = $request->tag_cold;
            $this->setting->tag_soft  = $request->tag_soft;
            $this->setting->tag_hot   = $request->tag_hot;
            $this->setting->status_id_cold = $request->status_id_cold;
            $this->setting->status_id_soft = $request->status_id_soft;
            $this->setting->status_id_hot  = $request->status_id_hot;
            $this->setting->staff_id_default   = $request->staffDefault;
            $this->setting->staff_id_cold = $request->staffCold;
            $this->setting->staff_id_soft = $request->staffSoft;
            $this->setting->staff_id_hot  = $request->staffHot;
            $this->setting->active  = $request->active ?? false;

            if ($this->setting->save() && $this->bizonAccount->save()) {

                Toast::success($request->get('toast', 'Успешно'));
            } else {
                Toast::error('Произошла ошибка при сохранении');
            }

        } catch (\Exception $exception) {

            Toast::error($request->get('toast', 'Произошла ошибка при сохранении'));

            Log::error(__METHOD__.' : '.Auth::user()->email.' '.$exception->getMessage());
        }
    }

    public function updateStatuses()
    {
        try {
            $account = Auth::user()->amoAccount();

            $this->amoApi = (new AmoApi($account));
            $this->amoApi->init();

            Pipeline::updateStatuses($this->amoApi, $account);

            Toast::success('Успешно обновлено');

        } catch (\Exception $exception) {

            $this->setting->active = false;//TODO
            $this->setting->save();

            Log::error(__METHOD__.' : '.Auth::user()->email.' '.$exception->getMessage());

            Alert::error('Произошла ошибка');
        }
    }

    public function updateStaffs(Request $request)
    {
        try {
            $account = Auth::user()->amoAccount();

            $this->amoApi = (new AmoApi($account));
            $this->amoApi->init();

            Staff::updateStaffs($this->amoApi, $account);

            Toast::success($request->get('toast', 'Успешно'));

        } catch (\Exception $exception) {

            Toast::error($request->get('toast', 'Произошла ошибка'));

            Log::channel('bizon')->error(Auth::user()->email.' '.$exception->getMessage());
        }
    }

    public function feedbackSave(Request $request)
    {
        ScreenHelper::feedbackSave($request);
    }

    public static function questionSave(Request $request)
    {
        ScreenHelper::questionSave($request);
    }
}
