<?php

namespace App\Models\GetCourse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'getcourse_settings';

    protected $fillable = [
        'user_id',
        'status_id_form',
        'status_id_payment',
        'status_id_order',
        'status_id_order_close',
        'active',
    ];
}
