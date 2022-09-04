<?php

namespace App\Models\AlfaCRM;

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

    public function checkStatusCame(int $statusId): bool
    {
       return match ($statusId) {

           $this->status_came_1 => true,
           $this->status_came_2 => true,
           $this->status_came_3 => true,
           default => false,
        };
    }

    public function getBranchId($lead)
    {
        $branchId = $this->branches()
            ->first()
            ->branch_id;

        $branchValue = $this->getFieldBranch($lead);

        if ($branchValue) {

            foreach ($this->branches as $branch) {

                if (trim(mb_strtolower($branch->name)) == trim(mb_strtolower($branchValue))) {

                    $branchId = $branch->branch_id;

                    break;
                }
            }
        }
        return $branchId;
    }

    public function getFieldBranch($lead): bool|\App\Models\amoCRM\Field
    {
        if ($this->branch_id) {

            $fieldBranch = \App\Models\amoCRM\Field::find($this->branch_id);
        }

        if (!empty($fieldBranch)) {

            if ($fieldBranch->field_id) {

                $branch = $lead->cf($fieldBranch->name)->getValue();
            }
        }
        return $branch ?? false;
    }

    public function branches()
    {
        return $this->hasMany(Branch::class)->where('is_active', true);
    }

    /*
        $fields - json в поле
        $code - поле из альфы
        $fieldId - id поля амо в бд
        $fieldValues - массив со значениями для клиента в АльфаСРМ
    */
    public function getFieldValues(Lead $lead, ?Contact $contact): array
    {
        foreach (json_decode($this->fields) as $code => $fieldId) {

            if ($fieldId !== null) {

                $amoField = Field::find($fieldId);

                $entity = $amoField->entity == 1 ? $contact : $lead;

                if ($amoField->field_id) {

                    $fieldValue = $entity->cf($amoField->name)->getValue();
                } else
                    $fieldValue = $entity->{$amoField->name};

                $fieldValues[$code] = $fieldValue;
            }
        }

        return $fieldValues ?? [];
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
