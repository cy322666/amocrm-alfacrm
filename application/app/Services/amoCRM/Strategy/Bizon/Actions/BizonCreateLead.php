<?php

namespace App\Services\amoCRM\Strategy\Bizon\Actions;

use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Viewer;

/**
 * Статический класс - реализация создания сделки
 * Реализуется в стратегиях бизон
 */
abstract class BizonCreateLead
{
    public static function createLead(
        ContactModel $contactModel,
        Viewer $viewer,
        BizonSetting $setting) : LeadModel
    {
        return (new LeadModel())
            ->setName('Новый посетитель вебинара')
            ->setStatusId($viewer->getStatusId($setting))
            ->setResponsibleUserId($setting->responsible_user_id)
            ->setContacts(
                (new ContactsCollection())
                    ->add(
                        (new ContactModel())
                            ->setId($contactModel->getId())
                            ->setIsMain(true)
                    )
            );
    }
}