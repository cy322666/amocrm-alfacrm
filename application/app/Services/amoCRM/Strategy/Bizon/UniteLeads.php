<?php

namespace App\Services\amoCRM\Strategy\Bizon;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\NotesCollection;
use AmoCRM\Collections\TagsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMApiNoContentException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Filters\ContactsFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\NoteType\CommonNote;
use AmoCRM\Models\NoteType\ServiceMessageNote;
use AmoCRM\Models\TagModel;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Viewer;
use App\Services\amoCRM\Strategy\Bizon\StrategyInterface;
use Laravel\Octane\Exceptions\DdException;

class UniteLeads implements StrategyInterface
{
    private AmoCRMApiClient $apiClient;
    private BizonSetting $setting;

    /**
     * @param BizonSetting $setting
     */
    public function __construct(BizonSetting $setting)
    {
        $this->setting = $setting;
    }

    public function setApiClient($apiClient): static
    {
        $this->apiClient = $apiClient;

        return $this;
    }

    public function getSetting(): BizonSetting
    {
        return $this->setting;
    }

    /**
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws AmoCRMMissedTokenException
     */
    public function searchContact(string $search_query): ?ContactModel
    {
        try {
            $contact = $this->apiClient
                ->contacts()
                ->get(
                    (new ContactsFilter())->setQuery($search_query)
                );

        } catch (AmoCRMApiNoContentException) {

            return null;
        }

        return $contact->first();
    }

    /**
     * @param ContactModel $model
     * @return mixed|null
     */
    public function searchLeads(ContactModel $model): ?LeadModel
    {
        $leads = $model->getLeads();

        if($leads !== null && $leads->first()) {

            foreach ($leads as $lead) {

                if($lead->getStatusId() != 142 && $lead->getStatusId()) {

                    break;
                }
            }
        }

        return $lead ?? null;
    }

    public function createLead(ContactModel $model, Viewer $viewer, BizonSetting $setting): LeadModel
    {
        $lead = (new LeadModel())
            ->setName('Новый посетитель вебинара')
            ->setStatusId($viewer->getStatusId($this->setting))
            ->setResponsibleUserId($setting->responsible_user_id)
            ->setContacts(
                (new ContactsCollection())
                    ->add(
                        (new ContactModel())
                            ->setId($model->getId())
                            ->setIsMain(true)
                    )
            );//TODO  ->setExternalId($sourceExternalId)

        try {
            $leadsCollection = $this->apiClient
                ->leads()
                ->add((
                    new LeadsCollection())->add($lead)
                );

            return $leadsCollection->first();

        } catch (AmoCRMApiException $exception) {

            //TODO log

            echo '<pre>';print_r($exception->getValidationErrors());echo '</pre>';

            return false;
        }
    }

    public function updateLead(LeadModel $lead, Viewer $viewer)
    {
        $lead->setStatusId($viewer->getStatusId($this->setting));

        try {
            $this->apiClient
                ->leads()
                ->updateOne($lead);

        } catch (AmoCRMApiException $e) {
            printError($e);
            die;
        }
    }

    public function createContact(Viewer $viewer): bool|ContactModel
    {
        $contact = (new ContactModel())
            ->setName($viewer->username)
            ->setCustomFieldsValues(
                new CustomFieldsValuesCollection()
            );

        $customFields = $contact->getCustomFieldsValues();

        if($viewer->phone !== null) {

            $phoneField = (new MultitextCustomFieldValuesModel())
                ->setFieldCode('PHONE');

            $customFields->add($phoneField);

            $phoneField->setValues(
                    (new MultitextCustomFieldValueCollection())
                        ->add(
                            (new MultitextCustomFieldValueModel())
                                ->setEnum('WORKDD')
                                ->setValue($viewer->phone)
                        )
                );
        }

        if($viewer->email !== null) {

            $emailField = (new MultitextCustomFieldValuesModel())
                ->setFieldCode('EMAIL');

            $customFields->add($emailField);

            $emailField->setValues(
                    (new MultitextCustomFieldValueCollection())
                        ->add(
                            (new MultitextCustomFieldValueModel())
                                ->setEnum('WORK')
                                ->setValue($viewer->email)
                        )
                );
            // $emailField = (new MultitextCustomFieldValuesModel())->setFieldCode('EMAIL');
            // $customFields->add($emailField);
        }

        try {
             return $this->apiClient
                ->contacts()
                ->addOne($contact);

        } catch (AmoCRMApiException $exception) {

            echo '<pre>';print_r($exception->getValidationErrors());echo '</pre>';
            //dd($exception->getLastRequestInfo());
            //TODO log
            return false;
        }
    }

    public function addLeadNote(LeadModel $lead, string $text): ?\AmoCRM\Models\NoteModel
    {
        $serviceMessageNote = (new CommonNote())
            ->setEntityId($lead->getId())
            ->setText($text)
            ->setCreatedBy(0);//TODO?

        $notesCollection = (new NotesCollection())->add($serviceMessageNote);

        try {
            $leadNotesService = $this->apiClient
                ->notes(EntityTypesInterface::LEADS);

            $notesCollection = $leadNotesService->add($notesCollection);

            return $notesCollection->first();

        } catch (AmoCRMApiException $exception) {

            //TODO log
            return false;
        }
    }

    public function addLeadTags(LeadModel $lead, array $tags)
    {
        $tagsCollection = new TagsCollection();

        foreach ($tags as $tag) {

            if($tag) {
                $tagsCollection->add(
                    (new TagModel())->setName($tag)
                );
            }
        }

        try {
            $lead->setTags($tagsCollection);

        } catch (AmoCRMApiException $exception) {

            dd($exception->getValidationErrors());
            //TODO log
            return false;
        }
    }
}