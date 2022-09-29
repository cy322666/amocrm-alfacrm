<?php

namespace App\Orchid\Layouts\Bizon;

use App\Models\Bizon\Webinar;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class WebinarIndexLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'webinars';

    protected function iconNotFound(): string
    {
        return 'icon-table';
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return 'Нет информации о полученных вебинарах';
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
        return 'Выполните нужные шаги на странице Подключение';
    }

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    //TD::make('last_name')->defaultHidden();
    protected function columns(): array
    {
        return [
            TD::make('start', 'Получено')
                ->render(function (Webinar $webinar) {

                    return Carbon::parse($webinar->created)->format('Y-m-d H:i:s');
                }),
            TD::make('end', 'Закончился')
                ->render(function (Webinar $webinar) {

                    return Carbon::parse($webinar->created)->addMinutes($webinar->len)->format('Y-m-d H:i:s');
                }),
            TD::make('room_title', 'Название комнаты')
                ->align('left')
                ->render(function (Webinar $webinar) {
                    return $webinar->room_title;
                }),
            TD::make('stat', 'Длительность')
                ->render(function (Webinar $webinar) {
                    return $webinar->len.' мин';
                }),
            TD::make('len', 'Посетителей')
                ->render(function (Webinar $webinar) {
                    return $webinar->stat;
                }),
//            TD::make('status', 'Статус')
//                //->filter(TD::FILTER_TEXT)
//                ->render(function (Webinar $webinar) {
//
//                    if($webinar->status == 1) return 'Выгружен';
//                    if($webinar->status == 0) return 'Выгружается';
//                }),
            TD::make('detail', 'Посетители')
                ->render(function (Webinar $webinar) {
                    return Link::make('Посетители')
                        ->type(Color::INFO())
                        ->route('bizon.viewers', $webinar);
                }),
        ];
    }
}
