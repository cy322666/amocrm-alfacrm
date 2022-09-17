<?php

namespace App\Models\Bizon;

abstract class ViewerNote
{
    public static function create(Viewer $viewer)
    {
        $note = [
            "Информация о зрителе",
            '----------------------',
            ' - Ник : ' . $viewer->username,
            ' - Телефон : ' . $viewer->phone,
            ' - Почта : ' . $viewer->email,
            ' - Город : ' . $viewer->city,
            ' - Присутствовал(а) : ' .$viewer->time. ' мин',
            ' - Когда зашел : '.$viewer->view ?? '-',
            ' - Когда вышел : ' .$viewer->viewTill ?? '-',
            ' - Присутствовал до конца : ' .$viewer->userFinished == true ? 'Да ' : 'Нет',
            ' - Кликал по банеру : ' .$viewer->clickBanner,
            ' - Кликал по кнопке : ' .$viewer->clickFile,
            ' - Комментарии : ' . "\n    ".implode("\n    ", json_decode($viewer->commentaries) ?? []),
        ];
        $note = implode("\n", $note);

        if($viewer->newOrder) {

            $noteOrder = [
                " ",
                "Информация о заказе",
                '----------------------',
                ' - ID заказа : ' . $viewer->newOrder,
                ' - Описание заказа : ' . $viewer->orderDetails
            ];
            $noteOrder = implode("\n", $noteOrder);

            $note = $note ."\n". $noteOrder;
        }

        return $note;
    }
}
