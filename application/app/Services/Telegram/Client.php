<?php

namespace App\Services\Telegram;

class Client
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.telegram.org/bot'.env('TG_TOKEN_MY');
    }

    public function send(string $message)
    {
        file_get_contents($this->baseUrl.'/sendMessage?chat_id='.env('TG_CHAT_ID_MY').'&text='.$message);
    }
}
