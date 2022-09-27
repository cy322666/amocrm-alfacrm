<?php

namespace App\Orchid\Screens\AlfaCRM;

use App\Models\User;
use App\Orchid\Layouts\AlfaCRM\Logs;
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
        User::saveMemoryInfo(__METHOD__);

        return [
            'transactions' => Auth::user()
                ->alfaTransactions()
                ->orderByDesc('created_at')
                ->paginate(20),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'События интеграции';
    }

    public function description(): ?string
    {
        return 'Вывод транзакций от систем и их итог';
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
            Logs::class,
        ];
    }
}
