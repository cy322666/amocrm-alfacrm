<?php

namespace App\Services\amoCRM\Strategy\Bizon\Actions;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMApiNoContentException;
use AmoCRM\Filters\ContactsFilter;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use App\Models\Api\Integrations\Bizon\Viewer;

/**
 * Статический класс - реализация поиска сделки
 * Реализуется в стратегиях бизон
 */
abstract class BizonSearchLead
{
    public static function searchLead($contact)
    {
        $leads = $contact->getLeads();

        if($leads !== null && $leads->first()) {

            foreach ($leads as $lead) {

                if($lead->getStatusId() != 142 && $lead->getStatusId()) {

                    break;
                }
            }
        }

        return $lead ?? null;
    }
}