<?php


namespace App\Models\amoCRM;


use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Status extends Model
{
    use AsSource;

    protected $fillable = [
        'account_id',
        'name',
        'status_id',
        'pipeline_id',
        'color',
        'sort',
    ];

    protected $table = 'amocrm_statuses';

    public $timestamps = false;

    public function pipeline(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pipeline::class);
    }
}
