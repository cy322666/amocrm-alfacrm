<?php


namespace App\Orchid\Layouts;


use App\Models\Api\Integrations\Bizon\Webinar;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

class BizonSettingPipeline extends Layout
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    //protected $target = 'pipeline_statuses';
    protected $target = 'webinars';
    
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('room_title', 'Название комнаты')
                ->render(function (Webinar $webinar) {
                    return Link::make($webinar->room_title)
                        ->route('bizon.orders.webinars', $webinar);
                }),
            TD::make('stat', 'Длительность')
                ->render(function (Webinar $webinar) {
                    return Link::make($webinar->email)
                        ->route('bizon.orders.webinars', $webinar);
                }),
            TD::make('len', 'Посетителей')
                ->render(function (Webinar $webinar) {
                    return Link::make($webinar->len)
                        ->route('bizon.orders.webinars', $webinar);
                }),
            TD::make('status', 'Статус')
                ->render(function (Webinar $webinar) {
                    return Link::make($webinar->status)
                        ->route('bizon.orders.webinars', $webinar);
                }),
        ];
    }
    
    public function build(Repository $repository)
    {
        // TODO: Implement build() method.
    }
}