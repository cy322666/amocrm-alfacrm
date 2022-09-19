<?php

namespace App\Orchid\Layouts\AlfaCRM;

use Carbon\Carbon;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class Logs extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'transactions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
                TD::make('created_at', 'Создано')
                    ->render(function ($transaction) {
                        return Carbon::parse($transaction->created_at)
                            ->format('Y-m-d H:i:s');
                    })
                    ->sort(),
                TD::make('amo_lead_id', 'ID сделки'),
                TD::make('alfa_branch_id', 'ID филиала'),
                TD::make('alfa_client_id', 'ID клиента'),
                TD::make('status', 'Событие')
                    ->render(function ($transaction) {
                        return match ($transaction->status) {
                            '1' => 'Записан',
                            '2' => 'Пришел',
                            '3' => 'Отменил',
                            default => 'Другое',
                        };
                    }),
                TD::make('error', 'Есть ошибка')
                    ->render(function ($transaction) {
                        return !empty($transaction->error);
                    })
                    ->defaultHidden(),
        ];
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return 'В интеграции пока не было событий';
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return 'Проверьте настройки или напишите нам';
    }
}
