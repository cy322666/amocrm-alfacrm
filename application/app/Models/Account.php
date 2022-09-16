<?php

namespace App\Models;

use App\Models\AlfaCRM\Branch;
use App\Models\AlfaCRM\LeadSource;
use App\Models\AlfaCRM\LeadStatus;
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
        'name',
        'code',
        'state',
        'subdomain',
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

    public function fields(string $class)
    {
        return $this->hasMany($class);//,  'account_id', 'id'
    }

    public function alfaSources()
    {
        return $this->hasMany(LeadSource::class);
    }

    public function amoStatuses()
    {
        return $this->hasMany(Status::class);
    }

    public function amoPipelines()
    {
        return $this->hasMany(Pipeline::class);
    }

    public function webhooks()
    {
        return $this->hasMany(Webhook::class);
    }

    public function alfaBranches()
    {
        return $this->hasMany(Branch::class);
    }

    public function alfaStatuses()
    {
        return $this->hasMany(LeadStatus::class, 'account_id', 'id' );
    }

    public function alfaSetting()
    {
        return $this->hasOne(Setting::class);
    }
}
