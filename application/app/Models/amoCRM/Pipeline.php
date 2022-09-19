<?php


namespace App\Models\amoCRM;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Pipeline extends Model
{
    protected $fillable = [
        'account_id',
        'is_main',
        'name',
        'pipeline_id',
    ];

    protected $table = 'amocrm_pipelines';

    public static function updateStatuses($amoApi, $account)
    {
        $account->amoPipelines()->delete();
        $account->amoStatuses()->delete();

        foreach ($amoApi->service
                     ->ajax()
                     ->get('/api/v4/leads/pipelines')
                     ->_embedded
                     ->pipelines as $pipeline) {

            $model = $account
                ->amoPipelines()
                ->create([
                    'pipeline_id' => $pipeline->id,
                    'name'        => $pipeline->name,
                    'is_main'     => $pipeline->is_main,
                    'is_archive'  => $pipeline->is_archive,
                ]);

            foreach ($pipeline
                         ->_embedded
                         ->statuses as $status) {

                $model->statuses()->create([
                    'status_id'  => $status->id,
                    'name'       => $status->name,
                    'color'      => $status->color,
                    'sort'       => $status->sort,
                    'account_id' => $account->id,
                ]);
            }
        }
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
