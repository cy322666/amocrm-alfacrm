<?php


namespace App\Models\amoCRM;


use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Staff extends Model
{
    use AsSource;

    protected $fillable = [
        'account_id',
        'name',
        'staff_id',
        'group',
    ];

    protected $table = 'amocrm_staffs';
}
