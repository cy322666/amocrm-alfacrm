<?php

namespace App\Models\Api\Integrations\Bizon;

use Illuminate\Database\Eloquent\Model;

class WebinarUTM extends Model
{
    protected $table = 'bizon_webinar_utm';
    
    protected $fillable = [
        'webinar_id',
        'type',
        'name',
        'val',
        'percent',
    ];
    
    public function webinar()
    {
        return $this->belongsTo(Webinar::class, 'id', 'webinar_id');
    }
}