<?php

namespace App\Orchid\Layouts\GetCourse;

use App\Models\GetCourse\Form;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FormTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'forms';

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
                ->render(function (Form $form) {
                    return Carbon::parse($form->created_at)->format('Y-m-d H:i:s');
                }),
            TD::make('name', 'Имя'),
            TD::make('email', 'Почта'),
            TD::make('phone', 'Телефон'),
            TD::make('contact_id', 'ID контакта')
                ->render(function (Form $form) use ($subdomain) {

                    if ($form->contact_id) {

                        return Link::make($form->contact_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/contacts/detail/'.$form->contact_id);
                    } else
                        return '-';
                }),
            TD::make('lead_id', 'ID сделки')
                ->render(function (Form $form) use ($subdomain) {

                    if ($form->lead_id) {

                        return Link::make($form->lead_id)
                            ->href('https://'.$subdomain.'.amocrm.ru/leads/detail/'.$form->lead_id);
                    } else
                        return '-';
                }),
            TD::make('status', 'Статус')
                ->sort()
                ->render(function (Form $form) {

                    if($form->status == 1) return 'Отправлен';
                    if($form->status == 0) return 'В очереди';
                }),
            TD::make('error', 'Есть ошибка')
                ->render(function (Form $form) {
                    return empty($form->error) ? 'Нет' : 'Да';
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
