<?php

namespace App\Jobs;

use AmoCRM\Client\AmoCRMApiClient;
use App\Facades\amoApi;
use App\Models\Api\Core\Account;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Viewer;
use App\Models\Api\Integrations\Bizon\Webinar;
use App\Services\amoCRM\Strategy\Bizon\SendFactory;
use App\Services\Bizon365\Client;
use App\Services\Bizon365\ViewerSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;

class BizonWebinarSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Количество попыток выполнения задания.
     *
     * @var int
     */
    public int $tries = 1;//TODO ?

    /**
     * Количество секунд, в течение которых задание может выполняться до истечения тайм-аута.
     *
     * @var int
     */
    public int $timeout = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Webinar $webinar,
        private BizonSetting $setting,

        private int $offset,
        private int $cursor)
    {
        $this->onQueue('bizon_export');
    }

    /**
     * Execute the job.
     * @return void
     * @throws DdException
     * @var AmoCRMApiClient $amoApi
     */
    public function handle()
    {
//
//        $amoApi = amoApi::getInstance();
//
//        $viewers = $this->webinar->viewers()
//            ->skip($this->offset)
//            ->take($this->cursor)
//            ->get();

//        foreach ($viewers as $viewer) {
//
//            $result = ViewerSender::send(
//                $amoApi,
//                $viewer,
//                SendFactory::getStrategy('unite_leads', $this->setting), //TODO strategy name
//                $this->setting);
//
//            $viewer->status = 'ok';//TODO ?
//            $viewer->save();
//        }
//
//        $wait_viewers = $this->webinar->viewers()
//            ->where('status', 'wait')
//            ->get();
//
//        if($wait_viewers->count() == 0) {
//
//            $this->webinar->status = 'ok';
//            $this->webinar->save();
//
//        }
    }
}
