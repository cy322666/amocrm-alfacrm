<?php

namespace App\Models\GetCourse;

use App\Models\User;
use App\Models\Webhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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

    public function webhooks()
    {
        return $this->hasMany(Webhook::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function createWebhooks(User $user)
    {
        $this->webhooks()->create([
            'user_id'  => $user->id,
            'app_name' => 'getcourse',
            'app_id'   => 3,
            'active'   => true,
            'path'     => 'getcourse.form',
            'type'     => 'status_form',
            'platform' => 'getcourse',
            'uuid'     => Uuid::uuid4(),
        ]);

        $this->webhooks()->create([
            'user_id'  => $user->id,
            'app_name' => 'getcourse',
            'app_id'   => 3,
            'active'   => true,
            'path'     => 'getcourse.payment',
            'type'     => 'status_payment',
            'platform' => 'getcourse',
            'uuid'     => Uuid::uuid4(),
        ]);

        $this->webhooks()->create([
            'user_id'  => $user->id,
            'app_name' => 'getcourse',
            'app_id'   => 3,
            'active'   => true,
            'path'     => 'getcourse.order',
            'type'     => 'status_order',
            'platform' => 'getcourse',
            'uuid'     => Uuid::uuid4(),
        ]);
    }
}
