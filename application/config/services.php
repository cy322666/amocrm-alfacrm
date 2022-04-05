<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'bizon' => [
        //количество отправляемых зрителей в амо в пакете
        'count' => 20,
    ],

    'amocrm' => [
        'client_id' => '8351a88a-3286-472d-b687-99c81651b65c',
        'app_name'  => 'clever-platform-dev',
        'description'  => 'description',
        'redirect_uri' => 'https://webhook.site/58d47d86-ea91-4c50-afb2-36523e5a554e',
        'secrets_uri'  => 'https://webhook.site/58d47d86-ea91-4c50-afb2-36523e5a554e',
        'logo' => '',
    ],

];
