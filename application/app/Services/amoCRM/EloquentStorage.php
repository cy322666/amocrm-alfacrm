<?php

namespace App\Services\amoCRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Ufee\Amo\Base\Storage\Oauth\AbstractStorage;
use Ufee\Amo\Oauthapi;

class EloquentStorage extends AbstractStorage
{
    public Model $model;

    public function __construct(array $options, Model $storage_model)
    {
        Log::debug(__METHOD__, $options);

        $this->options = $options;

        $this->model = $storage_model;
    }

    public function initClient(Oauthapi $client)
    {
        static::$_oauth = $this->getOauth();
    }

    public function setOauthData(Oauthapi $client, array $oauth): bool
    {
        static::$_oauth = $oauth;

        Log::debug(__METHOD__, $oauth);

        $this->setOauth($oauth);

        return true;
    }

    public function getOauthData(Oauthapi $client, $field = null)
    {
        return $this->getOauth();
    }

    private function getOauth() : array
    {
        Log::debug(__METHOD__, $this->model->toArray());

        return [
            'token_type'    => 'Bearer',
            'access_token'  => $this->model->access_token,
            'refresh_token' => $this->model->refresh_token,
            'expires_in'    => $this->model->expires_in,
            'created_at'    => $this->model->created_at,
        ];
    }

    private function setOauth(array $oauth) : array
    {
        Log::debug(__METHOD__, $oauth);

        $this->model->access_token  = $oauth['access_token'];
        $this->model->refresh_token = $oauth['refresh_token'];
        $this->model->expires_in    = $oauth['expires_in'];
        $this->model->created_at    = $oauth['created_at'];
        $this->model->save();

        return $oauth;
    }
}
