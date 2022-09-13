<?php

namespace App\Models;

use App\Models\AlfaCRM\Setting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;

class Webhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'app_id',
        'active',
        'path',
        'type',
        'platform',
        'uuid',
        'user_id',
    ];

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
