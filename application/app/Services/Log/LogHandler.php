<?php

namespace App\Services\Log;

use App\Exceptions\Handler;
use Monolog\Logger as Monolog;
use App\Models\Log;

class LogHandler extends Handler
{
    public function __construct($level = Monolog::DEBUG)
    {
        parent::__construct($level);
    }
    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        // Simple store implementation
        $log = new Log();
        $log->fill($record['formatted']);
        $log->save();
// Queue implementation
        //event(new LogMonologEvent($record));
    }
    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new LogFormatter();
    }
}