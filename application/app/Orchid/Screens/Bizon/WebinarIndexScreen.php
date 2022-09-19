<?php

namespace App\Orchid\Screens\Bizon;

use App\Models\Bizon\Webinar;
use App\Orchid\Layouts\Bizon\WebinarIndexLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
use Orchid\Screen\Screen;

class WebinarIndexScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Список вебинаров';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список вебинаров Бизон365';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'webinars' => Auth::user()
                ->bizonSetting
                ->webinars()
                ->orderBy('created_at', 'desc')
                ->paginate(),
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
            WebinarIndexLayout::class,
        ];
    }
}
