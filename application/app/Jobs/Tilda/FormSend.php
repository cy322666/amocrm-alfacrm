<?php

namespace App\Jobs\Tilda;

use App\Models\Tilda\TildaSetting;
use App\Models\Tilda\Transaction;
use App\Models\User;
use App\Models\Webhook;
use App\Services\amoCRM\Models\Contacts;
use App\Services\amoCRM\Models\Leads;
use App\Services\amoCRM\Models\Notes;
use App\Services\ManagerClients\TildaManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FormSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Webhook $webhook,
        public Transaction $transaction,
        public TildaSetting $setting,
        public User $user,
    )
    {
        $this->onQueue('tilda_site');
    }

    public function tags()
    {
        return [$this->user->email, 'tilda_site:'.$this->transaction->id];
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        Log::channel('tilda')->info('запуск job '.$this->transaction->id);

        try {

            $manager = (new TildaManager($this->webhook));

            $amoApi  = $manager->amoApi;
//            $account = $manager->amoAccount;

            $responsibleId = '';
            $statusId = '';

            $contact = Contacts::search([
                'Телефоны' => [$this->transaction->phone],
                'Почта'    => $this->transaction->email,
            ], $amoApi);

            if ($contact == null) {

                $contact = Contacts::create($amoApi, $this->transaction->name);
            }

            $contact = Contacts::update($contact, [
                'Телефоны' => [$this->transaction->phone],
                'Почта'    => $this->transaction->email,
            ]);

            $lead = $contact->leads->filter(function ($lead) {

                return $lead->status_id !== 142 && $lead->status_id !== 143;

            })?->first();

            if (empty($lead)) {

                $lead = Leads::create($contact, [
                    'status_id' => $statusId,
                    'responsible_user_id' => $responsibleId,
                ], 'Новая заявка Tilda');

            } else {

                $lead->status_id = $statusId;
                $lead->save();
            }

            Notes::addOne($lead, $this->transaction->text());//TODO

            $this->transaction->contact_id = $contact->id;
            $this->transaction->lead_id = $lead->id;
            $this->transaction->status = 1;
            $this->transaction->save();

        } catch (\Throwable $exception) {


        }

        Log::channel('tilda')->info('конец form job '.$this->transaction->id);

        return true;
    }
}
