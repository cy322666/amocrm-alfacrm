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
 * Статический класс - реализация поиска контакта
 * Реализуется в стратегиях бизон
 */
abstract class BizonSearchContact
{
    public static function searchContact(AmoCRMApiClient $apiClient, string $search_query)
    {
        try {
            $contact = $apiClient->contacts()
                ->get(
                    (new ContactsFilter())->setQuery($search_query)
                );

        } catch (AmoCRMApiNoContentException) {

            return null;
        }

        return $contact->first();
    }
}