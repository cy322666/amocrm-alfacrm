<?php

namespace App\Orchid\Screens\AlfaCRM;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class LogScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'transactions' => Auth::user()->alfaTransactions,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'События вашей интеграции';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            \Orchid\Support\Facades\Layout::table('transactions', [

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
                TD::make('comment', 'Комментарий'),
                TD::make('error', 'Текст ошибки'),
            ]),
        ];
    }
}
