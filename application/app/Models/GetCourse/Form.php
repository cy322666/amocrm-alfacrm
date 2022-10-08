<?php

namespace App\Models\GetCourse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Form extends Model
{
    use HasFactory, AsSource;

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

    public function text(): string
    {
        $note = [
            "Информация о заявке",
            '----------------------',
            ' - Имя : ' . $this->name,
            ' - Телефон : ' . $this->phone,
            ' - Почта : ' . $this->email,
        ];
        return implode("\n", $note);
    }
}
