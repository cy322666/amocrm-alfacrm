<?php

namespace App\Orchid\Layouts\Bizon;

use App\Models\Bizon\Viewer;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ViewerIndexLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'viewers';

    protected function textNotFound(): string
    {
        return 'Данных нет :(';
    }

    protected function striped(): bool
    {
        return false;
    }
    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return 'На вебинаре отсутствовали посетители';
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('created_at', 'Добавлен')
                //->sort()
//                ->defaultHidden()
                ->render(function (Viewer $viewer) {
                    return $viewer->created_at;
                }),
            TD::make('username', 'Имя')
                ->render(function (Viewer $viewer) {
                    return $viewer->username;
                }),
            TD::make('email', 'Почта')
                //->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {
                    return $viewer->email;
                }),
            TD::make('phone', 'Телефон')
                //->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {
                    return $viewer->phone;
                }),
            TD::make('time', 'Присутствовал')
//                ->filter(TD::FILTER_TEXT)
//                ->sort()
                ->render(function (Viewer $viewer) {
                    return $viewer->time.' мин';
                }),
            TD::make('type', 'Сегмент')
//                ->sort()
//                ->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {

                    return $viewer->type;
//                    switch ($viewer->type) {
//                        case 'hot' :
//                            return 'Горячий';
//                        case 'cold' :
//                            return 'Холодный';
//                        case 'soft' :
//                            return 'Теплый';
//                    }
                }),
            TD::make('contact_id', 'ID контакта')
                //->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {
                    //dd($viewer->webinar->user);
                    return Link::make($viewer->contact_id)
                        ->href('https://'.$viewer->webinar->account->subdomain.'/contacts/detail/'.$viewer->contact_id);
                }),
            TD::make('lead_id', 'ID сделки')
                //->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {

                    return Link::make($viewer->lead_id)
                        ->href('https://'.$viewer->webinar->account->subdomain.'/leads/detail/'.$viewer->lead_id);
                }),
            TD::make('status', 'Статус')
//                ->sort()
//                ->filter(TD::FILTER_TEXT)
                ->render(function (Viewer $viewer) {

                    return $viewer->status;
//                    if($viewer->status == 'send') return 'ОК';
//                    if($viewer->status == 'wait') return 'В очереди';
                }),
//            TD::make('detail', 'Детали')
//                ->render(function (Viewer $viewer) {
//                    return Link::make('Детали')
//                    ->route('bizon.orders.viewers.detail', $viewer);
//                }),
        ];
    }
}
