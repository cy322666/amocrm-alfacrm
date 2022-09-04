<?php

namespace App\Orchid\Layouts\AlfaCRM\Listeners;

use App\Orchid\Layouts\AlfaCRM\Settings\Statuses;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Listener;

class StatusListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = ['pipelines.'];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncPipelines';

    /**
     * @return Layout[]
     */
    protected function layouts(): iterable
    {
        return [
            Statuses::class,
        ];
    }
}
