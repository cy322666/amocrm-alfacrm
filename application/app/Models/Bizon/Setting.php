<?php

namespace App\Models\Bizon;

use App\Models\Account;
use App\Models\User;
use App\Models\Webhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

/**
 * @property mixed $account
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'pipeline_id',
        'user_id',
        'status_id_cold',
        'status_id_soft',
        'status_id_hot',
        'staff_id_cold',
        'staff_id_soft',
        'staff_id_hot',
        'tag',
        'tag_cold',
        'tag_soft',
        'tag_hot',
        'time_cold',
        'time_soft',
        'time_hot',
        'active',
    ];

    protected $table = 'bizon_settings';

    public function account(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id')->where('name', 'bizon');
    }

    public function webinars()
    {
        return $this->hasMany(Webinar::class);
    }

    public function webhooks()
    {
        return $this->hasMany(Webhook::class)->where('app_name', 'bizon');
    }

    public function createWebhooks(User $user)
    {
        $this->webhooks()->create([
            'user_id'  => $user->id,
            'app_name' => 'bizon',
            'app_id'   => 2,
            'active'   => true,
            'path'     => 'bizon.webinar',
            'type'     => 'webinar.end',
            'platform' => 'bizon',
            'uuid'     => Uuid::uuid4(),
        ]);
    }
}
