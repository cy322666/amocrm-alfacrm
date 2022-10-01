<?php

namespace App\Jobs\GetCourse;

use App\Models\GetCourse\Payment;
use App\Models\GetCourse\Setting;
use App\Models\User;
use App\Models\Webhook;
use App\Services\amoCRM\Models\Contacts;
use App\Services\amoCRM\Models\Leads;
use App\Services\amoCRM\Models\Notes;
use App\Services\ManagerClients\GetCourseManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentSend implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Webhook $webhook,
        public Payment $payment,
        public Setting $setting,
        public User $user,
    )
    {
        $this->onQueue('getcourse_payment');
    }

    /**
     * Execute the job.
     *
     * @return false
     */
    public function handle(): bool
    {
        try {
            $manager = (new GetCourseManager($this->webhook));

            $amoApi  = $manager->amoApi;
            $account = $manager->amoAccount;

            $responsibleId = $this->setting->responsible_user_id_payment ?? $this->setting->responsible_user_id_default;

            $contact = Contacts::search([
                'Телефоны' => [$this->payment->phone],
                'Почта'    => $this->payment->email,
            ], $amoApi);

            if ($contact !== null) {

                $contact = Contacts::create($amoApi, $this->payment->name);

                $contact = Contacts::update($contact, [
                    'Телефоны' => $this->payment->phone,
                    'Почта'    => $this->payment->email,
                ]);
            }

            $lead = $contact->leads->filter(function ($lead) {

                if ($lead->status_id !== 142 &&
                    $lead->status_id !== 143) {

                    return $lead;
                }
            })?->first();

            if (empty($lead)) {

                $lead = Leads::create($contact, [
                    'status_id' => $this->setting->status_id_payment,
                    'responsible_user_id' => $responsibleId,
                ], 'Новая оплата GetCourse');

            } else {

                $lead->status_id = $this->setting->status_id_payment;
                $lead->save();
            }

            $this->payment->contact_id = $contact->id;
            $this->payment->lead_id = $lead->id;
            $this->payment->save();

            Notes::addOne($lead, $this->payment->text());

        } catch (\Throwable $exception) {

            $this->payment->error = $exception->getMessage();
            $this->payment->save();

            return false;
        }

        return true;
    }
}
