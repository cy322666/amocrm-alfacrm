<?php

namespace App\Jobs\AlfaCRM;

use App\Models\AlfaCRM\Setting;
use App\Models\amoCRM\Field;
use App\Models\Webhook;
use App\Services\AlfaCRM\Models\Customer;
use App\Services\amoCRM\Client as amoApi;
use App\Services\AlfaCRM\Client as alfaApi;
use App\Services\amoCRM\Helpers\Notes;
use App\Services\ManagerClients\AlfaCRMManager\AlfaCRMManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



/**
 * Отправляет клиента после записи в АльфаСРМ
 */
class RecordWithoutLead implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Setting $setting,
        public Webhook $webhook,
        public array $data,
    )
    {
        $this->onConnection('alfacrm.record');
    }

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

        $lead = $amoApi->service
            ->leads()
            ->find($this->data['id']);

        $contact = $lead->contact;

        $alfaApi->branchId = $this->setting->getBranchId($lead);

        $fieldValues = $this->setting->getFieldValues($lead, $contact);

        Notes::addOne($lead, 'Синхронизировано с АльфаСРМ, ссылка на клиента >>>');

        $customerId = Setting::customerUpdateOrCreate($fieldValues, $alfaApi);

        //TODO сейвим транзакцию
    }
}
