<?php

namespace App\Models\Api\Integrations\Bizon;

use App\Jobs\BizonWebinarSend;
use Illuminate\Support\Facades\Log;

class BizonDispatcher
{
    public static function schedule(Webinar $webinar, BizonSetting $setting)
    {
        $count_viewers = $webinar->viewers()
            ->orderBy('time', 'DESC')
            ->count();

        $limit = config('services.bizon.count');

        for ($offset = 0, $cursor = $limit ; ($offset + $limit) < $count_viewers ; $offset += $limit) {

            Log::info(__METHOD__.' : offset > '.$offset.' cursor > '.$cursor);

            BizonWebinarSend::dispatch($webinar, $setting, $offset, $cursor);
        }

        Log::info(__METHOD__.' : offset > '.$offset.' cursor > '.$count_viewers - $offset);

        BizonWebinarSend::dispatch($webinar, $setting, $offset, $cursor)->afterCommit();
    }
}