<?php

namespace App\Models\AlfaCRM;

use App\Models\Webhook;
use App\Services\AlfaCRM\Mapper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'alfacrm_transactions';

    protected $fillable = [
        'user_id',
        'webhook_id',
        'fields',        //поля для отправки в альфу
        'amo_lead_id',
        'alfa_branch_id',
        'alfa_client_id',
        'comment',
        'status',
        'status_id',
        'error',
    ];

    public function setRecordData(array $data, Webhook $webhook)
    {
        $this->fill([
            'webhook_id'  => $webhook->id,
            'amo_lead_id' => $data['id'],
            'status_id'   => $data['status_id'],
            'comment' => 'created',
            'status'  => Mapper::RECORD,
        ]);
        $this->save();
    }
}
