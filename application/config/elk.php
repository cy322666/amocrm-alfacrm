<?php

return [
    'live' => [
        'enabled' => true,
        'schema' => 'http',
        'domain' => 'elastic_logstash_1',//logstash
        'port' => '9600',
        'index' => 'laravel_live',
        'type' => '_doc'
    ],
    'local' => [
        'enabled' => false,
        'schema' => 'http',
        'domain' => 'elastic_logstash_1',
        'port' => '9600',
        'index' => 'laravel_local',
        'type' => '_doc'
    ]
];
