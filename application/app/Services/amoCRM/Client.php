<?php

namespace App\Services\amoCRM;

use App\Models\Account;
use Exception;
use Ufee\Amo\Oauthapi;

class Client
{
    public Oauthapi $service;
    public EloquentStorage $storage;

    public function __construct(Account $account) {

        $this->storage = new EloquentStorage([
            'domain'    => $account->subdomain ?? null,
            'client_id' => $account->client_id ?? null,
            'client_secret' => $account->client_secret ?? null,
            'redirect_uri'  => env('AMOCRM_REDIRECT'),
        ], $account);

        \Ufee\Amo\Oauthapi::setOauthStorage($this->storage);
    }

    /**
     * @throws Exception
     */
    public function init(): Client
    {
        $this->service = Oauthapi::setInstance([
            'domain'        => $this->storage->model->subdomain,
            'client_id'     => $this->storage->model->client_id,
            'client_secret' => $this->storage->model->client_secret,
            'redirect_uri'  => env('AMOCRM_REDIRECT'),
        ]);

        try {
            $this->service->account;

        } catch (Exception $exception) {

            if ($this->storage->model->refresh_token) {

                $oauth = $this->service->refreshAccessToken($this->storage->model->refresh_token);

            } else {
                $oauth = $this->service->fetchAccessToken($this->storage->model->code);

                $this->storage->setOauthData($this->service, [
                    'token_type'    => 'Bearer',
                    'expires_in'    => $oauth['expires_in'],
                    'access_token'  => $oauth['access_token'],
                    'refresh_token' => $oauth['refresh_token'],
                    'created_at'    => $oauth['created_at'] ?? time(),
                ]);
            }
        }
        return $this;
    }
}
