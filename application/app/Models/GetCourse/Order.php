<?php

namespace App\Models\GetCourse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'getcourse_orders';

    protected $fillable = [
        'phone',
        'email',
        'name',
        'number',
        'order_id',
        'positions',
        'left_cost_money',
        'cost_money',
        'payed_money',
        'order_status',
        'status',
        'webhook_id',
        'user_id',
        'lead_id',
        'contact_id',
        'error',
    ];

    public function text(): string
    {
        $note = [
            "Информация о заявке",
            '----------------------',
            ' - Имя : ' . $this->name,
            ' - Телефон : ' . $this->phone,
            ' - Почта : ' . $this->email,
            ' - № Number : ' . $this->number,
            ' - № Заказа : ' . $this->order_id,
            ' - Позиции : ' . $this->positions,
            ' - Сумма : ' . $this->cost_money,
            ' - Оплачено : ' . $this->payed_money,
            ' - Осталось : ' . $this->left_cost_money,
            ' - Статус : ' . $this->order_status,
        ];
        return implode("\n", $note);
    }
}
