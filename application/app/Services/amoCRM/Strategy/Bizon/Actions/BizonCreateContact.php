<?php

namespace App\Services\amoCRM\Strategy\Bizon\Actions;

use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use App\Models\Api\Integrations\Bizon\Viewer;

/**
 * Статический класс - реализация создания контакта
 * Реализуется в стратегиях бизон
 */
abstract class BizonCreateContact
{
    /**
     * @param Viewer $viewer
     * @return bool|ContactModel
     */
    public static function createContact(Viewer $viewer): bool|ContactModel
    {
        $contact = (new ContactModel())
            ->setName($viewer->username ?? 'Неизвестно')
            ->setCustomFieldsValues(
                new CustomFieldsValuesCollection()
            );

        $customFields = $contact->getCustomFieldsValues();

        if($viewer->phone !== null) {

            self::setPhone($customFields, $viewer->phone);
        }

        if($viewer->email !== null) {

            self::setEmail($customFields, $viewer->email);
        }

        return $contact;
    }

    /**
     * @param $customFields
     * @param $phone
     * @return void
     */
    private static function setPhone(&$customFields, $phone)
    {
        $phoneField = (new MultitextCustomFieldValuesModel())
            ->setFieldCode('PHONE');

        $customFields->add($phoneField);

        $phoneField->setValues(
            (new MultitextCustomFieldValueCollection())
                ->add(
                    (new MultitextCustomFieldValueModel())
                        ->setEnum('WORKDD')
                        ->setValue($phone)
                )
        );
    }

    /**
     * @param $customFields
     * @param $email
     * @return void
     */
    private static function setEmail(&$customFields, $email)
    {
        $emailField = (new MultitextCustomFieldValuesModel())
            ->setFieldCode('EMAIL');

        $customFields->add($emailField);

        $emailField->setValues(
            (new MultitextCustomFieldValueCollection())
                ->add(
                    (new MultitextCustomFieldValueModel())
                        ->setEnum('WORK')
                        ->setValue($email)
                )
        );
    }
}