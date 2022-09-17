<?php

namespace App\Jobs;

use App\Models\Bizon\Setting;
use App\Models\Bizon\Viewer;
//use App\Services\Bizon365\ViewerSender;
use App\Services\amoCRM\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BizonViewerSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Количество попыток выполнения задания.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * Количество секунд, в течение которых задание может выполняться до истечения тайм-аута.
     *
     * @var int
     */
//    public int $timeout = 90;

    /**
     * Количество секунд ожидания перед повторной попыткой выполнения задания.
     *
     * @var int
     */
    public int $backoff = 10;

    /**
     * Indicate if the job should be marked as failed on timeout.
     *
     * @var bool
     */
    public bool $failOnTimeout = true;

    /**
     * Количество секунд, по истечении которых уникальная блокировка задания будет снята.
     *
     * @var int
     */
    public int $uniqueFor = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Viewer $viewer,
        private Setting $setting
    )
    {
        $this->onQueue('bizon_export');
    }

    /**
     * Получить посредника, через которого должно пройти задание.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [];
    }

    /**
     * Execute the job.
     * @return void
     * @var Client $amoApi
     */
    public function handle()
    {
        Log::info(__METHOD__.' > начало отправки viewer id : '.$this->viewer->id);

        try {
//        $strategy->setApiClient($amoApi);
//
//        $contact = $strategy->searchContact($viewer->phone ?? $viewer->email);
//
//        if ($contact == null) {
//            $contact = $strategy->createContact($viewer);
//        }
//
//        $lead = $strategy->searchLeads($contact);
//
//        if ($lead == null) {
//
//            if ($contact !== null)
//                $lead = $strategy->createLead($contact, $viewer, $setting);
//            else
//                return 'contact not created';
//        }
//
//        $note = $strategy->addLeadNote($lead, ViewerNote::create($viewer));
//
//        $strategy->addLeadTags($lead, [
//            $setting->tag,
//            $viewer->getTagType($setting),
//        ]);
//
//        $viewer->lead_id    = $lead->id;
//        $viewer->contact_id = $contact->id;
//        $viewer->note_id    = $note->id;
//        $viewer->status     = 'ok';
//        $viewer->save();
//
//        return 'ok';

            } catch (\Throwable $exception) {

            return $exception->getMessage().' > '.$exception->getFile().' > '.$exception->getLine();
        }

        Log::info(__METHOD__.' > результат отправки viewer id : '.$this->viewer->id.' '.$result);

        if(!Viewer::query()
            ->where('webinar_id', $this->viewer->webinar_id)
            ->where('status', '!=', 'ok')
            ->first()) {

            Log::info(__METHOD__.' > выгрузка webinar id : '.$this->viewer->webinar_id.' завершена');

            $this->viewer->webinar->status = 'ok';
            $this->viewer->webinar->save();
        }
    }
}
