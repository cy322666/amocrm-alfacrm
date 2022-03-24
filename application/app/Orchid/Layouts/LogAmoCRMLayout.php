<?php

namespace App\Orchid\Layouts;

use App\Models\Api\Logger as Log;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LogAmoCRMLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'logs';
    
    protected function textNotFound(): string
    {
        return 'Пока что логов нет';
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
        return '';
    }
    
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
    
            TD::make('start', 'Время')
                ->width(130)
                ->render(function (Log $log) {
                    
                    $time = explode(' ', $log->start)[1];
                    
                    $date = explode(' ', $log->start)[0];
                    
                    $month = explode('-', $date)[1];
                    
                    $day = explode('-', $date)[2];
                    
                    return $day.'/'.$month.' '.$time;
                }),
            TD::make('url', 'url')
                ->width(700)
                ->render(function (Log $log) {
                    return explode('amocrm.ru/', $log->url)[1];
                }),
            TD::make('method', 'Метод')
                ->width(50)
                ->render(function (Log $log) {
                    return $log->method;
                }),
            TD::make('code', 'Код')
                ->width(70)
                ->render(function (Log $log) {
                    return $log->code;
                }),
        ];
    }
}
