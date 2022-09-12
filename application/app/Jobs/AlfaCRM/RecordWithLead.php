<?php

namespace App\Jobs\AlfaCRM;

use App\Models\AlfaCRM\Customer;
use App\Models\AlfaCRM\Setting;
use App\Models\AlfaCRM\Transaction;
use App\Models\Webhook;
use App\Services\amoCRM\Models\Contacts;
use App\Services\amoCRM\Models\Notes;
use App\Services\ManagerClients\AlfaCRMManager;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecordWithLead implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Setting $setting,
        public Webhook $webhook,
        public Transaction $transaction,
        public array $data,
    ) {}

    /**
     * Execute the job.
     *
     * @return false
     * @throws Exception
     */
    public function handle(): bool
    {
        $manager = new AlfaCRMManager($this->webhook);

        $amoApi  = $manager->amoApi;
        $alfaApi = $manager->alfaApi;

        try {
            $lead = $amoApi->service
                ->leads()
                ->find($this->data['id']);

            $contact = $lead->contact;

            if (!$contact) {

                $this->transaction->error = 'Lead without contact';
                $this->transaction->save();

                return false;
            }

            $alfaApi->branchId = $this->setting::getBranchId($lead, $contact, $manager->alfaAccount, $this->setting);

            $stageId = $this->setting->stage_record_1;

            if (!$stageId) {

                $this->transaction->error = 'Stage id not select';
                $this->transaction->save();

                return false;
            }

            $fieldValues = $this->setting->getFieldValues($lead, $contact, $manager->amoAccount, $manager->alfaAccount);

            $fieldValues['lead_status_id'] = $stageId;
            $fieldValues['web'][] = Contacts::buildLink($amoApi, $contact->id);
            $fieldValues['branch_ids'][] = $alfaApi->branchId;//TODO бренчи затирает все еще?
            $fieldValues['is_study']   = 0;
            $fieldValues['legal_type'] = 1;

            $customer = Setting::customerUpdateOrCreate($fieldValues, $alfaApi);//TODO если уже есть?

            $this->transaction->alfa_client_id = $customer->id;
            $this->transaction->fields = $fieldValues;
            $this->transaction->alfa_branch_id = $alfaApi->branchId;

            Notes::addOne($lead, 'Синхронизировано с АльфаСРМ, ссылка на лид '.Customer::buildLink($alfaApi, $customer->id));

        } catch (\Throwable $exception) {

            $this->transaction->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
        }
        $this->transaction->save();
    }
}
