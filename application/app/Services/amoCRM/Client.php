<?php

namespace App\Services\amoCRM;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiClientFactory;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Client\Token\AccessToken;

class Client
{
    /**
     * @throws AmoCRMoAuthApiException
     */
    public function getInstance(): AmoCRMApiClient
    {
        $account = User::query()->first()->account;//TODO заменить эту хуйню

        $apiClient = (new AmoCRMApiClientFactory(
            new OauthEloquentConfig($account),
            new OauthEloquentService($account))
        )->make()
            ->setAccountBaseDomain($account->subdomain);

        if($account->access_token == null) {

            $access_token = $apiClient
                ->getOAuthClient()
                ->getAccessTokenByCode($account->code);

            if (!$access_token->hasExpired()) {

                $account->access_token  = $access_token->getToken();
                $account->refresh_token = $access_token->getRefreshToken();
                $account->expires_in    = $access_token->getExpires();
                $account->save();
            }
        } else {

            $access_token = new AccessToken([
                'access_token'  => $account->access_token,
                'refresh_token' => $account->refresh_token,
                'expires_in'    => $account->expires_in,
            ]);
        }
        $apiClient->setAccessToken($access_token);

        return  $apiClient;
    }
}