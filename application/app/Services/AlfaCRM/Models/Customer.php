<?php

namespace App\Services\AlfaCRM\Models;

use App\Services\AlfaCRM\Client;
use Illuminate\Support\Facades\Log;

class Customer
{
    public function __construct(private Client $client) {}

    public function all()
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'branch/index', [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "is_active" => 1,
                    "page"      => 0,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items;
    }

    public function get(int $id)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'customer/index?id='.$id, [
                'headers' => $this->client->headers(),
            ]);
dd($response);
        return json_decode($response->getBody()->getContents());
    }

    public function first()
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'customer/index', [
                'headers' => $this->client->headers(),
                'json' => [
                    "page" => 0
                ]
            ]);

        return json_decode($response->getBody()->getContents())->items[0];
    }

    public function search(string $value)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'customer/index', [
                'headers' => $this->client->headers(),
                'json' => [
                    "page"  => 0,
                    'phone' => $value,
                ],
            ]);

        return json_decode($response->getBody()->getContents());
    }

    public function update(int $id, array $params)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'customer/update?id='.$id, [
                'headers' => $this->client->headers(),
                'json'    => $params,
            ]);
    }

    public function create(array $params)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->domain}.".$this->client::$baseUrl.'customer/create', [//$this->client->branchId./
                'headers' => $this->client->headers(),
                'json'    => $params,
            ]);

        $response = json_decode($response->getBody()->getContents());

        if ($response->success === false) {

            Log::error(__METHOD__.' : client '.$this->client->domain, $response->errors);
        }

        return $response->model;
    }
}
