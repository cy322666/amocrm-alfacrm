<?php

namespace App\Models\AlfaCRM;

use App\Models\Account;
use App\Models\amoCRM\Field;
use App\Services\AlfaCRM\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ufee\Amo\Models\Contact;
use Ufee\Amo\Models\Lead;
use App\Services\AlfaCRM\Client as alfaApi;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'alfacrm_settings';

    protected $fillable = [
        'status_came_1',
        'status_came_2',
        'status_came_3',
        'status_record_1',
        'status_record_2',
        'status_record_3',
        'status_omission_1',
        'status_omission_2',
        'status_omission_3',

        'active',
        'work_lead',

        'name',
        'source',
        'responsible',
        'legal_name',
        'dob',
        'note',
        'phone',
        'web',

        'branch_id',
    ];

//    public function branches()
//    {
//        return $this->morphMany('');
//    }

    public function checkStatus(string $action, int $statusId): bool
    {
        $action = 'status_'.$action;

        return match ($statusId) {

            $this->{$action_1},
            $this->{$action_3},
            $this->{$action_2} => true,

            default => false,
        };
    }

    public static function getFieldBranch(Lead $lead, ?Contact $contact, Setting $setting): bool|\App\Models\amoCRM\Field
    {

        if ($setting->branch_id) {

            $fieldBranch = \App\Models\amoCRM\Field::find($setting->branch_id);
        }

        if (!empty($fieldBranch)) {

            if ($fieldBranch->field_id) {

                $entity = $fieldBranch->entity == 1 ? $contact : $lead;

                $branch = $entity->cf($fieldBranch->name)->getValue();
            }
        }
        return $branch ?? false;
    }

    /*
        $fields - json в поле
        $code - поле из альфы
        $fieldName - название поля амо в бд (в сущности)
        $fieldValues - массив со значениями для клиента в АльфаСРМ
    */
    public function getFieldValues(Lead $lead, ?Contact $contact, Account $account): array
    {
        foreach (json_decode($this->fields) as $code => $fieldName) {

            if ($fieldName !== null) {

                $amoField = $account->fields(Field::class)
                    ->where('name', $fieldName)
                    ->first();

                $entity = $amoField->entity == 1 ? $contact : $lead;

                if ($amoField->field_id) {

                    $fieldValue = $entity->cf($amoField->name)->getValue();
                } else
                    $fieldValue = $entity->{$amoField->code};

                $fieldValues[$code] = $fieldValue;
            }
        }

        return $fieldValues ?? [];
    }

    public static function getBranchId(Lead $lead, Contact $contact, Account $account, Setting $setting)
    {
        $branchId = $account->branches()
            ->orderBy('branch_id')
            ->first()
            ->branch_id;

        $branchValue = self::getFieldBranch($lead, $contact, $setting);

        if ($branchValue) {

            foreach ($account->branches as $branch) {

                if (trim(mb_strtolower($branch->name)) == trim(mb_strtolower($branchValue))) {

                    $branchId = $branch->branch_id;

                    break;
                }
            }
        }
        return $branchId;
    }

    public static function customerUpdateOrCreate(array $fieldValues, alfaApi $alfaApi)
    {
        //TODO email?
        if ($fieldValues['phone']) {

            $customer = (new Customer($alfaApi))->search($fieldValues['phone']);

            if (!$customer) {

                $customer = (new Customer($alfaApi))->create($fieldValues);
            }

            $customer = (new Customer($alfaApi))->update($customer['id'], $fieldValues);
        }
        //TODO лучше отдавать сущность
        return $customer['id'];
    }
}
