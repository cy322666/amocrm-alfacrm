<?php


namespace App\Exceptions;


class FeedbackExceptions extends \Exception
{
    public static $errors = [
        'Refresh access token error: Check the `client_id` parameter' => 'Ошибка авторизации amoCRM',
        '' => '',
    ];
}