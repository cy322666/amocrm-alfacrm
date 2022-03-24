<?php

namespace App\Orchid\Screens\Integrations\Bizon;

use App\Orchid\Layouts\BizonAnalyticsLayout;
use App\Orchid\Layouts\Examples\MetricsExample;
use Illuminate\Config\Repository;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class BizonAnalyticsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Аналитика';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Краткая аналитика по интеграции';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [

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
            Layout::view('helpers.dev'),
        ];
    }
}
