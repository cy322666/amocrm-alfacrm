<?php

namespace App\Services\AlfaCRM\Models;

use App\Services\AlfaCRM\Client;

class Customer
{
    public function __construct(private Client $client) {}

    public function all()
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->branchId}.".$this->client::$baseUrl.'branch/index', [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "is_active" => 1,
                    "page"      => 0,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items;
    }

    public function first()
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->branchId}.".$this->client::$baseUrl.'customer/index', [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "page"      => 0,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items[0];
    }

    public function search(string $value)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->branchId}.".$this->client::$baseUrl.'customer/index', [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "page"  => 0,
                    'phone' => $value,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items[0];
    }

    public function update(int $id, array $params)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->branchId}.".$this->client::$baseUrl.'customer/index?id='.$id, [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "page"  => 0,
                    $params,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items[0];
    }

    public function create(array $params)
    {
        $response = $this->client
            ->http
            ->post("https://{$this->client->branchId}.".$this->client::$baseUrl.'customer/create', [
                'headers' => $this->client->headers(),
                'body' => json_encode([
                    "page"  => 0,
                    $params,
                ]),
            ]);

        return json_decode($response->getBody()->getContents())->items[0];
    }
}
