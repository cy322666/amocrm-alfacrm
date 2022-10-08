<?php

namespace App\Jobs\GetCourse;

use App\Models\GetCourse\Order;
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
use Illuminate\Support\Facades\Log;

class OrderSend implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Setting $setting;

    public function __construct(
        public Webhook $webhook,
        public Order $order,
        public User $user,
    )
    {
        $this->onQueue('getcourse_order');

        $this->setting = $user->getcourseSetting;
    }

    public function tags()
    {
        return ['render', 'getcourse_order:'.$this->order->id];
    }

    /**
     * Execute the job.
     *
     * @return false
     */
    public function handle(): bool
    {
        Log::channel('getcourse')->info('запуск getcourse order job '.$this->order->id);

        try {
            $manager = (new GetCourseManager($this->webhook));

            $amoApi  = $manager->amoApi;
            $account = $manager->amoAccount;

            $responsibleId = $this->setting->responsible_user_id_order ?? $this->setting->responsible_user_id_default;

            $contact = Contacts::search([
                'Телефоны' => [$this->order->phone],
                'Почта'    => $this->order->email,
            ], $amoApi);

            if ($contact !== null) {

                $contact = Contacts::create($amoApi, $this->order->name);

                $contact = Contacts::update($contact, [
                    'Телефоны' => $this->order->phone,
                    'Почта'    => $this->order->email,
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
                    'status_id' => $this->setting->status_id_order,
                    'responsible_user_id' => $responsibleId,
                ], 'Новый заказ GetCourse');

            } else {

                $lead->status_id = $this->setting->status_id_order;
                $lead->save();
            }

            $this->order->contact_id = $contact->id;
            $this->order->lead_id = $lead->id;
            $this->order->save();

            Notes::addOne($lead, $this->order->text());

        } catch (\Throwable $exception) {

            $this->order->error = $exception->getMessage();
            $this->order->save();

            return false;
        }

        Log::channel('getcourse')->info('конец getcourse order job '.$this->order->id);

        return true;
    }
}
