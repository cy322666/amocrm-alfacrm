<?php

namespace App\Models\Tilda;

use App\Models\User;
use App\Models\Webhook;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class TildaSetting extends Model
{
    use HasFactory;

    public function webhooks(): HasMany
    {
        return $this->hasMany(Webhook::class);
    }

    public function transactions(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function createWebhooks(User $user)
    {
        $this->webhooks()->create([
            'user_id'  => $user->id,
            'app_name' => 'tilda',
            'app_id'   => 4,
            'active'   => true,
            'path'     => 'tilda.api.sites',
            'type'     => 'status_site',
            'platform' => 'getcourse',
            'uuid'     => Uuid::uuid4(),
        ]);
    }
}
