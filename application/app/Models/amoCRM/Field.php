<?php

namespace App\Models\amoCRM;

use App\Models\Account;
use App\Services\amoCRM\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Field extends Model
{
    use HasFactory, AsSource;

    private static array $lead = [
        [
            'name' => 'Название сделки',
            'code' => 'name',
        ],
        [
            'name' => 'Ответственный за сделку',
            'code' => 'responsible',
        ],
        [
            'name' => 'Бюджет',
            'code' => 'sale',
        ],
    ];

    private static array $contact = [
        [
            'name' => 'Имя контакта',
            'code' => 'name',
        ],
        [
            'name' => 'Ответственный за контакт',
            'code' => 'responsible',
        ],
    ];

    protected $table = 'amocrm_fields';

    protected $fillable = [
        'account_id',
        "field_id",
        "name",
        "code",
        "field_type",
        "sort",
        "is_multiple",
        "is_system",
        "is_editable",
        "enums",
        "values_tree",
        'entity',
    ];

    public static function updateFields(Client $amoApi, Account $account)
    {
        $account->fields(Field::class)
            ->where('entity', 2)
            ->delete();

        $amoApi->service
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

        $amoApi->service
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
    }

    public static function addDefaultForLead(Account $account)
    {
        foreach (self::$lead as $value) {

            Field::query()->create([
                'account_id' => $account->id,
                'is_system'  => true,
                'entity' => 2,
                'name' => $value['name'],
                'code' => $value['code'],
            ]);
        }
    }

    public static function addDefaultForContact(Account $account)
    {
        foreach (self::$contact as $value) {

            Field::query()->create([
                'account_id' => $account->id,
                'is_system'  => true,
                'entity' => 1,
                'name' => $value['name'],
                'code' => $value['code'],
            ]);
        }
    }
}
