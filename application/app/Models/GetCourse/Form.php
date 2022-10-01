<?php

namespace App\Models\GetCourse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'getcourse_forms';

    protected $fillable = [
        'email',
        'phone',
        'name',
        'status',
        'webhook_id',
        'user_id',
        'lead_id',
        'contact_id',
        'error',
    ];

    public static function text(Form $form): string
    {
        $note = [
            "Информация о заявке",
            '----------------------',
            ' - Имя : ' . $form->name,
            ' - Телефон : ' . $form->phone,
            ' - Почта : ' . $form->email,
        ];
        return implode("\n", $note);
    }
}
