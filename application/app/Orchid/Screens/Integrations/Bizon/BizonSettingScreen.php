<?php

namespace App\Orchid\Screens\Integrations\Bizon;

use AmoCRM\Client\AmoCRMApiClient;
use App\Facades\amoApi;
use App\Models\Api\amoCRM\Pipeline;
use App\Models\Api\amoCRM\Staff;
use App\Models\Api\amoCRM\Status;
use App\Models\Api\Core\Account;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\User;
use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BizonSettingScreen extends Screen
{
    public AmoCRMApiClient $amoApi;
    public BizonSetting $setting;
    public Account $account;
    
    public function __construct(Request $request)
    {
//        $this->account = Account::find(1);//->account;
//        $this->amoApi  = amoApi::getInstance();
//        $this->setting = BizonSetting::find(2);
    }
    
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Настройки';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Настройки интеграции';
    
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Request $request): array
    {

        $this->account = $request->user()->account;
        $this->setting = $this->account->bizon_settings;

        return [
            'staffs'    => $this->account->staffs ?? [],
            'statuses'  => $this->account->statuses ?? [],
            'pipelines' => $this->account->pipelines ?? [],
        ];
    }
    
    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Сайт')
                ->href('https://google.com')//TODO
                ->icon('globe-alt'),
    
            Link::make('Инструкция')
                ->href('https://google.com')//TODO
                ->icon('docs'),
    
            Link::make('Связаться')
                ->href('https://google.com')//TODO
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        $status_id_cold = $this->setting->status_id_cold;
        $status_id_soft = $this->setting->status_id_soft;
        $status_id_hot  = $this->setting->status_id_hot;
        
        $tag_cold = $this->setting->tag_cold;
        $tag_soft = $this->setting->tag_soft;
        $tag_hot  = $this->setting->tag_hot;
        $tag      = $this->setting->tag;
        
        $response_user_id   = $this->setting->response_user_id;
        $response_user_name = $this->setting->response_user_name;
    
        $time_cold = $this->setting->time_cold ?? 30;
        $time_soft = $this->setting->time_soft ?? 60;
        $time_hot  = $this->setting->time_hot ?? 90;
        
        return [

            Layout::tabs([

                'Сегментация' => Layout::rows([
    
                    Input::make('time_cold')
                        ->type('text')
                        ->title('Холодные')
                        ->value($time_cold)
                        ->popover('Зрители, которые присутствовали столько или менее этого значения'),
    
                    Input::make('time_soft')
                        ->type('text')
                        //->required()
                        ->title('Теплые')
                        ->value($time_soft)
                        ->popover('Зрители, которые  присутствовали меньше этого значения, но больше Холодных'),
    
                    Input::make('time_hot')
                        ->type('text')
                        ->title('Горячие')
                        ->value($time_hot)
                        ->popover('Зрители, которые присутствовали столько и более этого значения'),
    
                        Group::make([
                            Button::make('Сохранить')
                                ->method('saveTime')
                                ->type(Color::PRIMARY()),
                            
                            Button::make('Сбросить настройки')
                                ->method('dropTime')
                                ->type(Color::DEFAULT()),
                        ])->autoWidth(),
                ]),
                
                'Статус' => Layout::rows([
    
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
    
                    Group::make([
                        Button::make('Сохранить')
                            ->method('saveStatuses')
                            ->type(Color::PRIMARY()),
                        
                        Button::make('Обновить данные')
                            ->method('updateStatuses')
                            ->type(Color::DARK()),
                        
                        Button::make('Сбросить настройки')
                            ->method('dropStatuses')
                            ->type(Color::DEFAULT()),
                    ])->autoWidth(),
                ]),
                
                'Ответственный' => Layout::rows([
    
                    Input::make('responsible_user_id')
                        ->type('text')
                        ->title('Ответственный по умолчанию')
                        ->value($response_user_id)
                        ->help($response_user_name),
    
                    Group::make([
                        Button::make('Сохранить')
                            ->method('saveResponsible')
                            ->type(Color::WARNING()),
                        
                        Button::make('Обновить данные')
                            ->method('updateResponsible')
                            ->type(Color::DARK()),
                        
                        Button::make('Сбросить настройки')
                            ->method('dropResponsible')
                            ->type(Color::DEFAULT()),
                    ])->autoWidth(),
                ]),
    
                'Теги' => Layout::rows([
    
                    Input::make('tag')
                        ->type('text')
                        ->title('Тег для всех')
                        ->value($tag)
                        ->popover('Будет добавляться во все сделки. Если не нужно, то оставьте пустым'),
                    
                    Input::make('tag_cold')
                        ->type('text')
                        ->value($tag_cold)
                        ->title('Тег для Холодных')
                        ->popover('Будет добавляться в сделки Холодных клиентов. Если не нужно, то оставьте пустым'),
        
                    Input::make('tag_soft')
                        ->type('text')
                        ->title('Тег для Теплых')
                        ->value($tag_soft)
                        ->popover('Будет добавляться в сделки Теплых клиентов, то оставьте пустым'),
        
                    Input::make('tag_hot')
                        ->type('text')
                        ->title('Тег для Горячих')
                        ->value($tag_hot)
                        ->popover('Будет добавляться в сделки Горячих клиентов. Если не нужно, то оставьте пустым'),
                  
                    Group::make([
                        Button::make('Сохранить')
                            ->method('saveTag')
                            ->type(Color::PRIMARY()),
                        
                        Button::make('Сбросить настройки')
                            ->method('dropTag')
                            ->type(Color::DEFAULT()),
                    ])->autoWidth(),
                ]),
            ]),
            
            Layout::accordion([

                    'Статусы и Воронки' =>
                        Layout::table('statuses', [
    
                            TD::make('id', 'ID')
                                ->align('center')
                                ->width('120')
                                ->render(function (Status $model) {
    
                                    return '<div class="filled-circle" style="background-color: '.$model->color.'; border-radius: 20px">'.$model->status_id.'</div>';
                                }),
    
                            TD::make('name', 'Название')
                                ->width('250')
                                ->render(function (Status $model) {

                                    return $model->name;
                                }),
                            
                            TD::make('id', 'ID воронки')
                                ->width('150')
                                ->render(function (Status $model) {
                                    return $model->pipeline->pipeline_id;
                                }),

                            TD::make('name', 'Название воронки')
                                ->width('450')
                                ->render(function (Status $model) {
                                    return $model->pipeline->name;
                                }),
                        ]),
                'Сотрудники' =>
                    Layout::table('staffs', [
                        TD::make('id', 'id')
                            ->width('250')
                            ->render(function (Staff $model) {
                                return $model->staff_id;
                            }),
            
                        TD::make('name', 'Имя')
                            ->width('450')
                            ->render(function (Staff $model) {
                                return $model->name;
                            }),
                        
                        TD::make('group', 'Отдел')
                            ->width('450')
                            ->render(function (Staff $model) {
                                return $model->group;
                            }),
                    ]),
            ]),
        ];
    }
    
    /* Сегменты */
    public function saveTime(Request $request)
    {
        try {
            $this->setting->time_cold = $request->post('time_cold');
            $this->setting->time_soft = $request->post('time_soft');
            $this->setting->time_hot  = $request->post('time_hot');
        
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
            
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    public function dropTime(Request $request)
    {
        try {
            $this->setting->time_hot  = null;
            $this->setting->time_soft = null;
            $this->setting->time_cold = null;
    
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
        
            Toast::error($request->get('toast', 'Произошла ошибка'));
            //Toast::error($request->get('toast', $exception->getMessage()));
        }
    }
    
    /* Статусы */
    public function saveStatuses(Request $request)
    {
        try {
            $this->setting->fill([
                'status_id_hot' => $request->post('status_id_hot'),
                'status_id_soft' => $request->post('status_id_soft'),
                'status_id_cold' => $request->post('status_id_cold'),
            ]);
            
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
            
        } catch (\Exception $exception) {
            
            Toast::error($request->get('toast', $exception->getMessage()));
            //Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    public function updateStatuses(Request $request)
    {
        try {

            Status::query()
                ->where('account_id', $this->account->id)
                ->delete();
    
            $array_pipelines = $this->amoApi
                ->pipelines()
                ->get();

            foreach($array_pipelines as $pipeline) {
        
                Pipeline::create([
                    'name'        => $pipeline->name,
                    'pipeline_id' => $pipeline->id,
                    'account_id'  => $this->account->id,
                    'color'       => $pipeline->color,
                ]);
                
                $array_statuses = $this->amoApi
                    ->statuses($pipeline->id)
                    ->get();
                
                foreach ($array_statuses as $status) {

                    if($status->id == 142 || $status->id == 143 || $status->name == 'Неразобранное') {

                        continue;
                    }

                    Status::query()->create([
                        'pipeline_id' => $pipeline->id,
                        'name'        => $status->name,
                        'status_id'   => $status->id,
                        'color'       => $status->color,
                        'account_id'  => $this->account->id,
                    ]);
                }
            }
            
            Toast::success($request->get('toast', 'Успешно'));
            
        } catch (\Exception $exception) {
            
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', $exception->getMessage()));//'Произошла ошибка'));
        }
    }
    
    public function dropStatuses(Request $request)
    {
        try {
            $this->setting->status_id_hot  = null;
            $this->setting->status_id_soft = null;
            $this->setting->status_id_cold = null;
    
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
            
        } catch (\Exception $exception) {
            
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    /* Ответственные */
    public function saveResponsible(Request $request)
    {
        try {
            $staff = Staff::query()
                ->where('staff_id', $request->post('responsible_user_id'))
                ->first();

            $this->setting->response_user_id   = $staff->staff_id;
            $this->setting->response_user_name = $staff->name;
            
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
        
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    public function updateResponsible(Request $request)
    {
        try {
            Staff::query()
                ->where('account_id', $this->account->id)
                ->delete();

            $users = $this->amoApi->users()->get();

            foreach ($users as $user) {

                Staff::query()->create([
                    'account_id' => $this->account->id,
                    'name' => $user->name,
                    'group' => $user->group,//TODO
                    'staff_id' => $user->id,//TODO role
                ]);
            }
        
            Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
        
            Toast::error($request->get('toast', $exception->getMessage()));
            //Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    public function dropResponsible(Request $request)
    {
        try {
            $this->setting->response_user_id = null;
            
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
            
        } catch (\Exception $exception) {
            
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    /* Теги */
    
    public function dropTag(Request $request)
    {
        try {
            $this->setting->tag_hot  = null;
            $this->setting->tag_soft = null;
            $this->setting->tag_cold = null;
            $this->setting->tag      = null;
    
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
        
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
    
    public function saveTag(Request $request)
    {
        try {
            $this->setting->fill([
                'tag_hot'  => $request->post('tag_hot'),
                'tag_soft' => $request->post('tag_soft'),
                'tag_cold' => $request->post('tag_cold'),
                'tag'      => $request->post('tag'),
            ]);
        
            if($this->setting->save())
                Toast::success($request->get('toast', 'Успешно'));
        
        } catch (\Exception $exception) {
        
            //Toast::error($request->get('toast', $exception->getMessage()));
            Toast::error($request->get('toast', 'Произошла ошибка'));
        }
    }
}
