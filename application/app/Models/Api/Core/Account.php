<?php

namespace App\Models\Api\Core;

use App\Models\Api\amoCRM\Pipeline;
use App\Models\Api\amoCRM\Staff;
use App\Models\Api\amoCRM\Status;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Webinar;
use App\Models\Api\Logger;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Account extends Model
{
    use HasFactory, AsSource;
    
    public $timestamps = false;
    
    protected $fillable = [
        'code',
        'state',
        'client_id',
        'client_secret',
        'referer',
        'expires_in',
        'created_at',
        'token_type',
        'endpoint',
        'expires_tariff',
    ];

    protected $guarded = [];

    public function getTarrif()
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
    
    public function bizon_settings(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BizonSetting::class);
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public static function generateUrl(string $client_id = null): string
    {
        return env('APP_URL').''.\Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function access(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Access::class);
    }

    public function webinars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Webinar::class);
    }
    
    public function staffs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Staff::class);
    }
    
    public function statuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Status::class);
    }
    
    public function pipelines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pipeline::class);
    }
    
    public function logs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Logger::class);
    }
}
