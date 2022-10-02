<?php

namespace App\Orchid\Screens;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Support\Facades\Toast;

class ScreenHelper
{
    public static function questionSave(Request $request)
    {
        (new \App\Services\Telegram\Client())->send('Вопрос из кабинета '.Auth::user()->email.' | контакты '.$request->contacts.' сообщение : '.$request->message);

        Feedback::query()->create([
            'user' => Auth::user()->email,
            'message'  => $request->message,
            'contacts' => $request->contacts,
            'type' => 'question',
        ]);

        Toast::success('Сообщение отправлено');
    }

    public static function feedbackSave(Request $request)
    {
        (new \App\Services\Telegram\Client())->send('Фидбек из кабинета '.Auth::user()->email.' | сообщение : '.$request->message);

        Feedback::query()->create([
            'user' => Auth::user()->email,
            'message' => $request->message,
            'type' => 'feedback',
        ]);

        Toast::success('Сообщение отправлено');
    }
}
