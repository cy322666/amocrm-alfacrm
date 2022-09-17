<?php

namespace App\Orchid\Screens\Bizon;

use App\Models\Bizon\Webinar;
use App\Models\Bizon\Viewer;
use App\Orchid\Layouts\ViewerIndexLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
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
        return [
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
        return [
//            Button::make('Экспорт')
//                ->method('export')
//                ->icon('cloud-download')
//                ->rawClick()
//                ->novalidate(),
        ];
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

    public function export()
    {
//        return response()->streamDownload(function () {
//            $csv = tap(fopen('php://output', 'wb'), function ($csv) {
//                fputcsv($csv, ['header:col1', 'header:col2', 'header:col3']);
//            });
//
//            collect([
//                ['row1:col1', 'row1:col2', 'row1:col3'],
//                ['row2:col1', 'row2:col2', 'row2:col3'],
//                ['row3:col1', 'row3:col2', 'row3:col3'],
//            ])->each(function (array $row) use ($csv) {
//                fputcsv($csv, $row);
//            });
//
//            return tap($csv, function ($csv) {
//                fclose($csv);
//            });
//        }, 'viewers '.date('Y-m-d H:i:s').'.csv');
    }
}
