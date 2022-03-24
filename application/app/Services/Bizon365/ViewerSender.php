<?php

namespace App\Services\Bizon365;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Exceptions\AmoCRMApiException;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Viewer;
use App\Services\amoCRM\Strategy\Bizon\StrategyInterface;
use Dflydev\DotAccessData\Data;

abstract class ViewerSender
{
    public static function send(AmoCRMApiClient $amoApi, Viewer $viewer, StrategyInterface $strategy, BizonSetting $setting) :string|bool
    {
        try {
            $strategy->setApiClient($amoApi);

            $contact = $strategy->searchContact($viewer->phone ?? $viewer->email) ?? $strategy->createContact($viewer);
            $lead    = $strategy->searchLeads($contact) ?? $strategy->createLead($contact, $viewer, $setting);
            $note    = $strategy->addLeadNote($lead, $viewer->createTextForNote());

            $strategy->addLeadTags($lead, [
                $setting->tag,
                $viewer->getTagType($setting),
            ]);

            $viewer->lead_id    = $lead->id;
            $viewer->contact_id = $contact->id;
            //$viewer->note_id    = $note->id;
            $viewer->status     = 'ok';
            $viewer->save();

            return true;

        } catch (\Throwable $exception) {

            print_r($exception->getTraceAsString());
            //print_r($exception->getTraceAsString());
            dd($exception->getMessage().' '.$exception->getFile().' '.$exception->getLine());
            //return $exception->getMessage();
        }
    }
}