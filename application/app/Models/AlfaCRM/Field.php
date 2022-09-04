<?php

namespace App\Models\AlfaCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Field extends Model
{
    use HasFactory, AsSource;

    protected $table = 'alfacrm_fields';

    protected $fillable = [
        'account_id',
        'entity',
        'name',
        'code',
    ];
}
