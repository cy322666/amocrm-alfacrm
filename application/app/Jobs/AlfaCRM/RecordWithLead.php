<?php

namespace App\Jobs\AlfaCRM;

use App\Models\AlfaCRM\Customer;
use App\Models\AlfaCRM\Setting;
use App\Models\AlfaCRM\Transaction;
use App\Models\Webhook;
use App\Services\amoCRM\Models\Contacts;
use App\Services\amoCRM\Models\Notes;
use App\Services\ManagerClients\AlfaCRMManager;
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
     * @return void
     */
    public function handle()
    {
        $manager = new AlfaCRMManager($this->webhook);

        $amoApi  = $manager->amoApi;
        $alfaApi = $manager->alfaApi;

        try {
            $lead = $amoApi->service
                ->leads()
                ->find($this->data['id']);

            $contact = $lead->contact;//TODO если нет контакта

            $alfaApi->branchId = $this->setting::getBranchId($lead, $contact, $manager->alfaAccount, $this->setting);

            //TODO поиск статуса
            //TODO проверка клиента на тип, если клиент то не трогать, если новый создавать лид

            $fieldValues = $this->setting->getFieldValues($lead, $contact, $manager->amoAccount, $manager->alfaAccount);

            $fieldValues['web'][] = Contacts::buildLink($amoApi, $contact->id);
            $fieldValues['branch_ids'][] = $alfaApi->branchId;//TODO бренчи затирает
            $fieldValues['is_study']   = 1;
            $fieldValues['legal_type'] = 1;

            $customer = Setting::customerUpdateOrCreate($fieldValues, $alfaApi);

            $this->transaction->alfa_client_id = $customer->id;
            $this->transaction->fields = $fieldValues;
            $this->transaction->alfa_branch_id = $alfaApi->branchId;

            Notes::addOne($lead, 'Синхронизировано с АльфаСРМ, ссылка на клиента '.Customer::buildLink($alfaApi, $customer->id));

        } catch (\Throwable $exception) {

            $this->transaction->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
        }
        $this->transaction->save();
    }
}
