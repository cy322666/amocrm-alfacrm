<?php

namespace App\Orchid\Screens\Integrations\Bizon;

use App\Models\Api\Integrations\Bizon\Viewer;
use Orchid\Platform\Models\User;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class ViewerDetailScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Посетитель';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Полная информация посетителя';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Viewer $viewer): array
    {
        return [
            'viewer' => $viewer,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::legend('viewer', [
                Sight::make('username', 'Имя'),
                Sight::make('email', 'Почта'),
                Sight::make('phone', 'Телефон'),
                Sight::make('playVideo', 'Вебинар запустился')
                    ->render(function (Viewer $viewer) {
                    
                    return $viewer->playVideo === 1 ? 'Да' : 'Нет';
                }),
                Sight::make('ip', 'IP'),
                Sight::make('mob', 'С мобильного')->render(function (Viewer $viewer) {
            
                        return $viewer->mob === 1 ? 'Да' : 'Нет';
                    }),
                Sight::make('useragent', 'Браузер'),
                Sight::make('referer', 'Откуда перешел'),
                Sight::make('utm_term', 'utm_term'),
                //Sight::make('chatUserId', 'ID в чате'),
                Sight::make('country', 'Страна'),
                Sight::make('region', 'Регион'),
                
                Sight::make('view', 'Когда зашел')->render(function (Viewer $viewer) {
                    
                    return $viewer->view.' мин';
                }),
                Sight::make('viewTill', 'Когда вышел')->render(function (Viewer $viewer) {
    
                    return $viewer->view.' мин';
                }),
                Sight::make('time', 'Присутсвовал')->render(function (Viewer $viewer) {
    
                    return $viewer->time.' мин';
                }),
                Sight::make('messages_num', 'Количество сообщений'),
                Sight::make('contact_id', 'ID контакта'),
                Sight::make('lead_id', 'ID сделки'),
                Sight::make('status', 'Статус импорта в amoCRM')->render(function (Viewer $viewer) {
     
                    if($viewer->status == 'send') return 'Выгружен';
                    if($viewer->status == 'wait') return 'В очереди';
                    
                    return 'В очереди';
                }),
                Sight::make('finished', 'Присутствовал до конца')->render(function (Viewer $viewer) {
    
                    return $viewer->finished === 1 ? 'Да' : 'Нет';
                }),
                Sight::make('clickBanner', 'Клик по баннеру')->render(function (Viewer $viewer) {
    
                    return $viewer->clickBanner === 1 ? 'Да' : 'Нет';
                }),
                Sight::make('clickFile', 'Клик по кнопке')->render(function (Viewer $viewer) {
    
                    return $viewer->clickFile === 1 ? 'Да' : 'Нет';
                }),
                Sight::make('newOrder', 'Заказ')->render(function (Viewer $viewer) {
    
                    return $viewer->newOrder != null ? $viewer->newOrder : '-';
                }),
                Sight::make('orderDetail', 'Детали заказа')->render(function (Viewer $viewer) {
    
                    return $viewer->orderDetail != null ? $viewer->orderDetail : '-';
                }),
                Sight::make('type', 'Сегмент')->render(function (Viewer $viewer) {
    
                    if($viewer->type == 'hot') return 'Горячий';
                    if($viewer->type == 'cold') return 'Холодный';
                    if($viewer->type == 'soft') return 'Теплый';
    
                    return '';
                }),
            ]),
            
//            Layout::legend('viewer', [
//                Sight::make('commentaries', 'Комментарии')->render(function (Viewer $viewer) {
//
//                    if($viewer->messages_num > 0) {
//                        //TODO
//                        return str_replace(' [',  "</br> [", implode("\n", json_decode($viewer->commentaries)));
//                    }
//                }),
//            ]),
        ];
    }
}
