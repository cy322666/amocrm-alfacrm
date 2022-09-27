<?php

namespace App\Orchid\Screens\Bizon;

use App\Models\Bizon\Webinar;
use App\Models\User;
use App\Orchid\Layouts\Bizon\ViewerIndexLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;

class ViewerIndexScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список посетителей';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список посетителей вебинаров Бизон 365';

    /**
     * Query data.
     *
     * @param Webinar $webinar
     * @return array
     */
    public function query(Webinar $webinar): array
    {
        User::saveMemoryInfo(__METHOD__);

        return [
            'account' => $webinar->account,
            'viewers' => $webinar->viewers()
                ->orderBy('status', 'desc')
                ->paginate(20),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            ViewerIndexLayout::class
        ];
    }
}
