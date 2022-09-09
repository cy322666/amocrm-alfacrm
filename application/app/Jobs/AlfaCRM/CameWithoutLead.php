<?php

namespace App\Jobs\AlfaCRM;

use App\Models\Account;
use App\Models\AlfaCRM\Setting;
use App\Models\AlfaCRM\Transaction;
use App\Models\Webhook;
use App\Services\AlfaCRM\Models\Customer;
use App\Services\ManagerClients\AlfaCRMManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CameWithoutLead implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Setting $setting,
        public Webhook $webhook,
        public Transaction $transaction,
        public array $data,
    )
    {

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

        try {

            if ($this->transaction->amo_lead_id) {

                $lead = $amoApi->service
                    ->leads()
                    ->find($this->transaction->amo_lead_id);
            } else {

                $alfaApi->branchId = $this->transaction->alfa_client_id;

                $customer = (new Customer($alfaApi))->get($this->transaction->alfa_client_id);

                $contact = $amoApi->service
                    ->contacts()
                    ->search($customer->phone)?->first();

                $pipelineId = Auth::user()
                    ->account('amocrm')
                    ->statuses()
                        ->where('status_id', $this->setting->status_came_1)
                        ->first()
                            ->pipeline
                            ->pipeline_id;

                if ($contact) {
                    $lead = $contact->leads->each(function ($lead) use ($pipelineId) {

                        if ($lead->pipeline_id == $pipelineId &&
                            $lead->status_id !== 142 &&
                            $lead->status_id !== 143) {

                            return $lead;
                        }
                    });

                    if (!$lead) {
                        $this->transaction->error = 'Not found active lead in need pipeline amoCRM';
                    }
                } else {
                    $this->transaction->error = 'Not found contact in amoCRM';
                }
            }

            $lead->status_id = $this->setting->status_came_1;
            $lead->save();

            $this->transaction->amo_lead_id = $lead->id;

        } catch (\Throwable $exception) {

            $this->transaction->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
        }
        $this->transaction->save();
    }
}
