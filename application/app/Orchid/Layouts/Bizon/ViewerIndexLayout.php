<?php

namespace App\Orchid\Layouts\Bizon;

use App\Models\Bizon\Viewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ViewerIndexLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'viewers';

    protected function textNotFound(): string
    {
        return 'Данных нет :(';
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
        return 'На вебинаре отсутствовали посетители';
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        $subdomain = Auth::user()->amoAccount()->subdomain;

        return [
            TD::make('created_at', 'Добавлен')
                ->sort()
                ->defaultHidden()
                ->render(function (Viewer $viewer) {
                    return Carbon::parse($viewer->created_at)->format('Y-m-d H:i:s');
                }),
            TD::make('username', 'Имя'),
            TD::make('email', 'Почта')->defaultHidden(),
            TD::make('phone', 'Телефон'),
            TD::make('time', 'Присутствовал')
                ->sort()
                ->render(function (Viewer $viewer) {
                    return $viewer->time.' мин';
                }),
            TD::make('type', 'Сегмент')
                ->sort()
                ->render(function (Viewer $viewer) {

                    return match ($viewer->type) {
                        'hot'  => 'Горячий',
                        'cold' => 'Холодный',
                        'soft' => 'Теплый',
                    };
                }),
            TD::make('contact_id', 'ID контакта')
                ->render(function (Viewer $viewer) use ($subdomain) {

                    if ($viewer->contact_id) {

                        return Link::make($viewer->contact_id)
                            ->href('https://'.$subdomain.'/contacts/detail/'.$viewer->contact_id);
                    } else
                        return '-';
                }),
            TD::make('lead_id', 'ID сделки')
                ->render(function (Viewer $viewer) use ($subdomain) {

                    if ($viewer->lead_id) {

                        return Link::make($viewer->contact_id)
                            ->href('https://'.$subdomain.'/leads/detail/'.$viewer->lead_id);
                    } else
                        return '-';
                }),
            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Viewer $viewer) {

                    if($viewer->status == 1) return 'Отправлен';
                    if($viewer->status == 0) return 'В очереди';
                }),
        ];
    }
}
