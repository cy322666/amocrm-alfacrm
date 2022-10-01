<?php

namespace App\Orchid\Layouts\GetCourse;

use App\Models\GetCourse\Order;
use App\Models\GetCourse\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PaymentTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'payments';

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
                ->render(function (Payment $payment) {
                    return Carbon::parse($payment->created_at)->format('Y-m-d H:i:s');
                }),
            TD::make('name', 'Имя'),
            TD::make('email', 'Почта'),
            TD::make('phone', 'Телефон'),
            TD::make('number', '№ Платежа'),
            TD::make('order_id', '№ Заказа'),
            TD::make('positions', 'Позиции'),
            TD::make('left_cost_money', 'Осталось'),
            TD::make('cost_money', 'Сумма'),
            TD::make('payed_money', 'Оплачено'),
            TD::make('payment_status', 'Статус платежа'),
            TD::make('link', 'Ссылка на платеж'),
            TD::make('contact_id', 'ID контакта')
                ->render(function (Payment $payment) use ($subdomain) {

                    if ($payment->contact_id) {

                        return Link::make($payment->contact_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/contacts/detail/'.$payment->contact_id);
                    } else
                        return '-';
                }),
            TD::make('lead_id', 'ID сделки')
                ->render(function (Payment $payment) use ($subdomain) {

                    if ($payment->lead_id) {

                        return Link::make($payment->lead_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/leads/detail/'.$payment->lead_id);
                    } else
                        return '-';
                }),
            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Payment $payment) {

                    if($payment->status == 1) return 'Отправлен';
                    if($payment->status == 0) return 'В очереди';
                }),
            TD::make('error', 'Есть ошибка')
                ->render(function (Payment $payment) {
                    return empty($payment->error) ? 'Нет' : 'Да';
                }),
        ];
    }
}
