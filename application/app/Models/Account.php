<?php

namespace App\Models;

use App\Models\AlfaCRM\Setting;
use App\Models\amoCRM\Field;
use App\Models\amoCRM\Pipeline;
use App\Models\amoCRM\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Account extends Model
{
    use HasFactory, AsSource;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'account_id',
        'code',
        'state',
        'client_id',
        'work',
        'client_secret',
        'referer',
        'expires_in',
        'created_at',
        'token_type',
        'redirect_uri',
        'endpoint',
        'expires_tariff',
    ];

    protected $guarded = [];

    public function tariff()
    {
        $expires_date = explode(' ', $this->expires_tariff)[0];

        switch ($this->status) {

            case 'trial':
            default :
                return 'Пробный (до '.$expires_date.')';
            case 'active':
                return 'Оплачен (до '.$expires_date.')';
            case 'end':
                return 'Не оплачен';
        }
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function setting(string $class)
    {
        return $this->hasOne($class)->first();
    }

    public function fields(string $class)
    {
        return $this->hasMany($class);//,  'account_id', 'id'
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function pipelines()
    {
        return $this->hasMany(Pipeline::class);
    }

    public function webhooks()
    {
        return $this->hasMany(Webhook::class);
    }
}
