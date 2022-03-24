<?php


namespace App\Services\Log;

use Monolog\Logger as Monolog;

class Logger extends Monolog
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array $config
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        dd($this);
        $logger = new Monolog('database');
        //$logger->pushHandler(new LogHandler());
        //$logger->pushProcessor(new LogProcessor());
        return $logger;
    }
}