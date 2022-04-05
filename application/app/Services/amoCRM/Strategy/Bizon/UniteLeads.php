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
use App\Services\amoCRM\Strategy\Bizon\Actions\BizonCreateContact;
use App\Services\amoCRM\Strategy\Bizon\Actions\BizonCreateLead;
use App\Services\amoCRM\Strategy\Bizon\Actions\BizonSearchContact;
use App\Services\amoCRM\Strategy\Bizon\Actions\BizonSearchLead;
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

    public function createContact(Viewer $viewer): bool|ContactModel
    {
        return BizonCreateContact::createContact($viewer);
    }

    public function searchContact($apiClient, $search_query): bool|ContactModel
    {
        return BizonSearchContact::searchContact($apiClient, $search_query);
    }

    /**
     * @param ContactModel $contactModel
     * @return mixed|null
     */
    public function searchLeads(ContactModel $contactModel): ?LeadModel
    {
        return BizonSearchLead::searchLead($contactModel);
    }

    public function createLead(ContactModel $contactModel, Viewer $viewer, BizonSetting $setting): LeadModel
    {
        return BizonCreateLead::createLead($contactModel, $viewer, $setting);
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