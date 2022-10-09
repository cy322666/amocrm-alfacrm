<?php

namespace App\Orchid\Layouts\GetCourse;

use App\Models\GetCourse\Form;
use App\Models\GetCourse\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        $subdomain = Auth::user()->amoAccount()->subdomain;

        return [

            TD::make('created_at', 'Добавлен')
                ->sort()
                ->defaultHidden()
                ->render(function (Order $order) {
                    return Carbon::parse($order->created_at)->format('Y-m-d H:i:s');
                }),
            TD::make('name', 'Имя'),
            TD::make('email', 'Почта')->defaultHidden(),
            TD::make('phone', 'Телефон'),
            TD::make('order_id', '№ Заказа')->defaultHidden(),
            TD::make('positions', 'Тариф')->defaultHidden(),
            TD::make('left_cost_money', 'Осталось')->defaultHidden(),
            TD::make('cost_money', 'Бюджет'),
            TD::make('payed_money', 'Оплачено'),
            TD::make('payment_status', 'Статус заказа'),
//            TD::make('link', 'Ссылка на платеж')->defaultHidden(),
            TD::make('contact_id', 'ID контакта')
                ->render(function (Order $order) use ($subdomain) {

                    if ($order->contact_id) {

                        return Link::make($order->contact_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/contacts/detail/'.$order->contact_id);
                    } else
                        return '-';
                }),
            TD::make('lead_id', 'ID сделки')
                ->render(function (Order $order) use ($subdomain) {

                    if ($order->lead_id) {

                        return Link::make($order->lead_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/leads/detail/'.$order->lead_id);
                    } else
                        return '-';
                }),
            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Order $order) {

                    if($order->status == 1) return 'Отправлен';
                    if($order->status == 0) return 'В очереди';
                }),
            TD::make('error', 'Есть ошибка')
                ->render(function (Order $order) {
                    return empty($order->error) ? 'Нет' : 'Да';
                }),
        ];
    }

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
