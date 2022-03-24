<?php

namespace App\Orchid\Screens;

use App\Models\Api\Logger as Log;
use App\Orchid\Layouts\LogAmoCRMLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class LogAmoCRMScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Логи amoCRM';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Логи amoCRM';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $account = Auth::user()->account;
        
        return [
            'logs' => Log::where('account_id', $account->id)
                ->orderBy('start', 'desc')
                ->paginate(),
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
            LogAmoCRMLayout::class,
        ];
    }
}
