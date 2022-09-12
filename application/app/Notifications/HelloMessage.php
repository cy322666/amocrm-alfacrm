<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;
use Orchid\Support\Color;

class HelloMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return [DashboardChannel::class];
    }

    public function toDashboard($notifiable): DashboardMessage
    {
        return (new DashboardMessage())
            ->title('Добро пожаловать!')
            ->message('Это раздел уведомлений, в нем вы будете видеть важные оповещения системы. А если возникнут вопросы: пишите в телеграм @blackclever')
            ->type(Color::SUCCESS())
            ->action(route('platform.start'));
    }
}
