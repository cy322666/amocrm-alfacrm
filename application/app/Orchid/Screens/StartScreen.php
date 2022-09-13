<?php

namespace App\Orchid\Screens;

use App\Models\Feedback;
use App\Services\Telegram\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class StartScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Стартовая страница';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Задать вопрос')
                ->method('questionSave')
                ->modal('question')
                ->icon('globe-alt'),

            ModalToggle::make('Обратная связь')
                ->method('feedbackSave')
                ->modal('feedback')
                ->icon('social-github'),
        ];
    }

    public function feedbackSave(Request $request)
    {
        (new Client())->send('Фидбек из кабинета '.Auth::user()->email.' | сообщение : '.$request->message);

        Feedback::query()->create([
            'user'    => Auth::user()->email,
            'message' => $request->message,
            'type'    => 'feedback',
        ]);

        Toast::success('Сообщение отправлено');
    }

    public function questionSave(Request $request)
    {
        (new Client())->send('Вопрос из кабинета '.Auth::user()->email.' | контакты '.$request->contacts.' сообщение : '.$request->message);

        Feedback::query()->create([
            'user'    => Auth::user()->email,
            'message' => $request->message,
            'type'    => 'question',
        ]);

        Toast::success('Сообщение отправлено');
    }

    /**
     * Views.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            Layout::view('start'),

            /* Модалки для кнопок дашборда */

            Layout::modal('requestDevForm', Layout::rows([
                Input::make('contacts')
                    ->title('Ваши контакты')
                    ->required()
                    ->help('Оставьте свои контакты для связи'),

                TextArea::make('message')
                    ->title('Сообщение')
                    ->help('Расскажите о разработке вкратце')
                    ->required(),
            ]))
                ->closeButton('Закрыть')
                ->applyButton('Отправить')
                ->title('Запрос на разработку'),

            Layout::modal('requestCRMForm', Layout::rows([
                Input::make('contacts')
                    ->title('Ваши контакты')
                    ->required()
                    ->help('Оставьте свои контакты для связи'),

                TextArea::make('message')
                    ->title('Сообщение')
                    ->help('Расскажите о запросе вкратце')
                    ->required(),
            ]))
                ->closeButton('Закрыть')
                ->applyButton('Отправить')
                ->title('Запрос на внедрение'),

            Layout::modal('requestLicenseForm', Layout::rows([
                Input::make('contacts')
                    ->title('Ваши контакты')
                    ->required()
                    ->help('Оставьте свои контакты для связи'),

                TextArea::make('message')
                    ->title('Сообщение')
                    ->help('Сколько сотрудников и на какой срок нужно')
                    ->required(),
            ]))
                ->closeButton('Закрыть')
                ->applyButton('Отправить')
                ->title('Задайте на лицензии'),

            Layout::modal('feedback', Layout::rows([
                TextArea::make('message')
                    ->title('Сообщение')
                    ->help('Вы точно будете услышаны!')
                    ->required(),
            ]))
                ->closeButton('Закрыть')
                ->applyButton('Отправить')
                ->title('Оставьте обратную связь'),

            /* Модалки для кнопок панели */

            Layout::modal('question', Layout::rows([
                Input::make('contacts')
                    ->title('Ваши контакты')
                    ->required()
                    ->help('Оставьте свои контакты для связи'),

                TextArea::make('message')
                    ->title('Сообщение')
                    ->help('Например запрос на доработку или внедрение')
                    ->required(),
            ]))
                ->closeButton('Закрыть')
                ->applyButton('Отправить')
                ->title('Задайте свой вопрос'),
        ];
    }

    public function requestDevSend(Request $request)
    {
        (new Client())->send('Запрос на разработку из кабинета '.Auth::user()->email.' | сообщение : '.$request->message);

        Feedback::query()->create([
            'user'    => Auth::user()->email,
            'message' => $request->message,
            'type'    => 'dev',
        ]);

        Toast::success('Сообщение отправлено');
    }

    public function requestCRMSend(Request $request)
    {
        (new Client())->send('Запрос на внедрение из кабинета '.Auth::user()->email.' | сообщение : '.$request->message);

        Feedback::query()->create([
            'user'    => Auth::user()->email,
            'message' => $request->message,
            'type'    => 'crm',
        ]);

        Toast::success('Сообщение отправлено');
    }

    public function requestLicenseSend(Request $request)
    {
        (new Client())->send('Запрос на лицензии из кабинета '.Auth::user()->email.' | сообщение : '.$request->message);

        Feedback::query()->create([
            'user'    => Auth::user()->email,
            'message' => $request->message,
            'type'    => 'license',
        ]);

        Toast::success('Сообщение отправлено');
    }
}
