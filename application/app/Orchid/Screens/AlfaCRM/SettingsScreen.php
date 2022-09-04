<?php

namespace App\Orchid\Screens\AlfaCRM;

use App\Models\AlfaCRM\Setting;
use App\Models\amoCRM\Field;
use App\Models\Webhook;
use App\Orchid\Layouts\AlfaCRM\Settings\Fields;
use App\Orchid\Layouts\AlfaCRM\Settings\FieldsHelp;
use App\Orchid\Layouts\AlfaCRM\Settings\Help;
use App\Orchid\Layouts\AlfaCRM\Settings\Info;
use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use App\Orchid\Layouts\AlfaCRM\Listeners\StatusListener;
use App\Orchid\Layouts\AlfaCRM\Settings\StatusFields;
use App\Orchid\Layouts\Examples\TabMenuExample;
use App\Services\AlfaCRM\Models\Branch;
use App\Services\AlfaCRM\Models\Customer;
use App\Services\amoCRM\Client as AmoApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Services\AlfaCRM\Client as AlfaApi;
use Ramsey\Uuid\Uuid;

class SettingsScreen extends Screen
{
    public $setting;
    public $account;
    public $amoAccount;

    public $whStatusCame;
    public $whStatusOmission;
    public $whStatusRecord;

    public $fields;
    public $fieldsAlfaCRM;
    public $fieldsBranch;

    public function query(): iterable
    {
        $account = Auth::user()
            ->account('alfacrm');

        $setting = $account
            ->setting(Setting::class);

        $amoAccount = Auth::user()->account();

        return [
            'statuses' => $account
                ->statuses()
                ->where('name', '!=', 'Неразобранное')
                ->get(),

            'whStatusCame' => Webhook::query()
                ->where('app_id', 1)
                ->where('type', 'status_came')
                ->where('user_id', Auth::user()->id)
                ->first(),

            'whStatusOmission' => Webhook::query()
                ->where('app_id', 1)
                ->where('type', 'status_omission')
                ->where('user_id', Auth::user()->id)
                ->first(),

            'whStatusRecord' => Webhook::query()
                ->where('app_id', 1)
                ->where('type', 'record')
                ->where('user_id', Auth::user()->id)
                ->first(),

            'account'    => $account,
            'setting'    => $setting,
            'amoAccount' => $amoAccount,

            'fieldsBranch' =>
                $amoAccount->fields(Field::class)
                    ->where('field_type', 4)
                    ->orWhere('field_type', 1)
                    ->pluck('name', 'id')
                    ->unique(),

            'fields' => json_decode($setting->fields),

            'fieldsAlfaCRM' => $account->fields(\App\Models\AlfaCRM\Field::class)->get(),
            'fieldsAmoCRM'  => $amoAccount->fields(Field::class)->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Настройки';
    }

    public function commandBar(): iterable
    {
        return [
            //TODO справка
            //TODO обратная связь
            //TODO тех поддержка
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(Info::class)
                ->title('Статус интеграции')
                ->description('Проверьте все настройки'),

            Layout::block(Layout::rows([
                Group::make([
                    Button::make('Поля amoCRM')
                        ->method('updateFieldsAmo')
                        ->type(Color::DEFAULT()),

                    Button::make('Статусы amoCRM')
                        ->method('updateStatusesAmo')
                        ->type(Color::DEFAULT()),

                    Button::make('Поля AlfaCRM')
                        ->method('updateFieldsAlfa')
                        ->type(Color::DEFAULT()),

                    Button::make('Общее AlfaCRM')
                        ->method('updateSystemAlfa')
                        ->type(Color::DEFAULT()),

                ])->autoWidth()
            ]))
                ->title('Обновить данные')
                ->description('Если нужно обновить данные систем, то нажмите нужную кнопку'),

            Layout::tabs([
                'Поля' => Layout::columns([
                    $this->prepareFields(),
                    FieldsHelp::class,
                ]),
                'Статусы' => Layout::columns([
                    Layout::rows([
                        Select::make('setting.branch_id')
                            ->title('Поле для соотношения филиалов')
                            ->options($this->fieldsBranch)
                            ->empty('Не выбрано'),

                        Input::make('setting.status_record_1')
                            ->title('Этап записи')
                            ->required()
                            ->help('Этап на котором клиента записывают на пробное'),

                        Input::make('setting.status_came_1')
                            ->title('Этап посещения')
                            ->required()
                            ->help('Этап на который сделка передвигается при посещении пробного'),

                        Input::make('setting.status_omission_1')
                            ->title('Этап пропуска')
                            ->required()
                            ->help('Этап на который сделка передвигается при отмене/пропуске пробного'),
                    ]),
                    StatusListener::class,
                ]),
                'Вебхуки' => [
                    Layout::rows([
                        Label::make('wh1')
                            ->title('Хук о посещении пробного')
                            ->value(URL::route($this->whStatusCame->path, [
                                'webhook' => $this->whStatusCame->uuid,
                            ])),

                        Label::make('wh2')
                            ->title('Хук о пропуске пробного')
                            ->value(URL::route($this->whStatusOmission->path, [
                                'webhook' => $this->whStatusOmission->uuid,
                            ])),
                    ]),
                ]
            ]),
        ];
    }

    private function prepareFields(): \Orchid\Screen\Layouts\Rows
    {
        $fields = [];

        //поле для ссылки на клиента в альфе
//        $fields[] = Input::make('')
//            ->title('Поле для ссылки ')
//            ->help('Будет записана ссылк');

        foreach ($this->fieldsAlfaCRM as $field) {

            $fields[] = Input::make('fields.'.$field->code)
                ->title($field->name)
                ->value($this->fields->{$field->code} ?? null);
        }

        return Layout::rows($fields);
    }

    public function save(Request $request, AmoApi $amocrm)
    {
        try {
            Log::info(__METHOD__, $request->toArray());

            $this->account->fill([
                'code'      => $request->account['code'],
                'client_id' => $request->account['client_id'],
                'subdomain' => $request->account['subdomain'],
            ]);
            $this->setting->save();

            $this->setting->fill([
                'status_came_1'     => $request->setting['status_came_1'],
                'status_record_1'   => $request->setting['status_record_1'],
                'status_omission_1' => $request->setting['status_omission_1'],

                'active'    => $request->setting['active'] ?? false,
                'work_lead' => $request->setting['work_lead'],

                'branch_id' => $request->setting['branch_id'],
            ]);

            $this->setting->fields = $request->fields;
            $this->setting->save();

            if (!$this->whStatusCame &&
                !$this->whStatusOmission &&
                !$this->whStatusRecord) {

                $this->account->webhooks()->create([
                    'user_id'  => Auth::user()->id,
                    'app_name' => 'alfacrm',
                    'app_id' => 1,
                    'active' => true,
                    'path'   => 'alfacrm.came',
                    'type'   => 'status_came',
                    'platform' => 'alfacrm',
                    'uuid'   => Uuid::uuid4(),
                ]);

                $this->account->webhooks()->create([
                    'user_id'  => Auth::user()->id,
                    'app_name' => 'alfacrm',
                    'app_id' => 1,
                    'active' => true,
                    'path'   => 'alfacrm.omission',
                    'type'   => 'status_omission',
                    'platform' => 'alfacrm',
                    'uuid'   => Uuid::uuid4(),
                ]);

                $wh = $this->amoAccount->webhooks()->create([
                    'user_id'  => Auth::user()->id,
                    'app_name' => 'alfacrm',
                    'app_id' => 1,
                    'active' => true,
                    'path'   => 'alfacrm.record',
                    'type'   => 'status_record',
                    'platform' => 'amocrm',
                    'uuid'   => Uuid::uuid4(),
                ]);

                $amocrm->init();

                $response = $amocrm->service
                    ->webhooks()
                    ->subscribe($wh->path, ['status_lead']);
            }

            Toast::success('Успешно сохранено');

        } catch (\Exception $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            Alert::error($exception->getMessage().' '.$exception->getLine());
        }
        //TODO check auth
    }

    public function updateFieldsAmo(AmoApi $amocrm)
    {
        try {
            $amocrm->init();

            $account = $this->amoAccount;

            $account->fields(Field::class)
                ->where('entity', 2)
                ->delete();

            $amocrm->service
                ->account
                ->customFields
                ->leads->each(function ($field) use ($account) {

                    $account->fields(Field::class)->create([
                        'account_id' => $account->id,
                        "field_id"   => $field->id,
                        "name" => $field->name,
                        "code" => $field->code,
                        "field_type"  => $field->field_type,
                        "sort"        => $field->sort,
                        "is_multiple" => $field->is_multiple,
                        "is_system"   => $field->is_system,
                        "is_editable" => $field->is_editable,
                        "enums"       => $field->enums ? json_encode($field->enums) : null,
                        "values_tree" => $field->values_tree,
                        'entity'      => 2,
                    ]);
                });

            Field::addDefaultForLead($account);

            $account->fields(Field::class)
                ->where('entity', 1)
                ->delete();

            $amocrm->service
                ->account
                ->customFields
                ->contacts->each(function ($field) use ($account) {

                    $account->fields(Field::class)->create([
                        'account_id' => $account->id,
                        "field_id"   => $field->id,
                        "name" => $field->name,
                        "code" => $field->code,
                        "field_type"  => $field->field_type,
                        "sort"        => $field->sort,
                        "is_multiple" => $field->is_multiple,
                        "is_system"   => $field->is_system,
                        "is_editable" => $field->is_editable,
                        "enums"       => $field->enums ? json_encode($field->enums) : null,
                        "values_tree" => $field->values_tree,
                        'entity'      => 1,
                    ]);
                });

            Field::addDefaultForContact($account);

            Toast::success('Успешно обновлено');

        } catch (\Exception $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            Alert::error($exception->getMessage());
        }
    }

    public function updateStatusesAmo(AmoApi $amocrm)
    {
        try {
            $amocrm->init();

            $account = $this->account;

            $account->pipelines()->delete();
            $account->statuses()->delete();

            $amocrm
                ->service
                ->account
                ->pipelines
                ->each(function($pipeline) use ($account) {

                    $model = $account
                        ->pipelines()
                        ->create([
                            'pipeline_id' => $pipeline->id,
                            'name'        => $pipeline->name,
                            'is_main'     => $pipeline->is_main,
                        ]);

                    $pipeline->statuses->each(function($status) use ($model, $account) {

                        $model->statuses()->create([
                            'status_id'  => $status->id,
                            'name'       => $status->name,
                            'color'      => $status->color,
                            'sort'       => $status->sort,
                            'account_id' => $account->id,
                        ]);
                    });
                });

            Toast::success('Успешно обновлено');

        } catch (\Exception $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            Alert::error($exception->getMessage());
        }
    }

    public function updateFieldsAlfa(AlfaApi $alfaApi)
    {
        $alfaApi->init();

        $this->account->fields(\App\Models\AlfaCRM\Field::class)->delete();

        foreach((new Customer($alfaApi))->first() as $fieldName => $fieldValue) {

            if (!in_array($fieldName, \App\Models\AlfaCRM\Customer::$ignoreFields)) {

                $this->account
                    ->fields(\App\Models\AlfaCRM\Field::class)
                    ->create([
                        'code'   => $fieldName,
                        'name'   => \App\Models\AlfaCRM\Customer::matchField($fieldName),
                        'entity' => 1,
                    ]);
            }
        }
    }

    public function updateSystemAlfa(AlfaApi $alfaApi)
    {
        foreach((new Branch($alfaApi))->all() as $branch) {

            \App\Models\AlfaCRM\Branch::create([
                'account_id' => 2,
                'branch_id' => $branch->id,
                'name' => $branch->name,
                'is_active' => $branch->is_active,
                'weight' => $branch->weight,
                'subject_ids' => json_encode($branch->subject_ids),
            ]);
        }
    }
}
