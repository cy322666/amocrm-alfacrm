<?php


namespace App\Models\amoCRM;


use App\Models\Account;
use App\Services\amoCRM\Client;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Staff extends Model
{
    use AsSource;

    protected $fillable = [
        'account_id',
        'name',
        'staff_id',
        'group',
    ];

    protected $table = 'amocrm_staffs';

    public static function updateStaffs(Client $amoApi, Account $amoAccount)
    {
        $amoAccount->amoStaffs()->delete();

        $amoApi->service
            ->account
            ->users
            ->each(function($user) use ($amoAccount){

                $amoAccount
                    ->amoStaffs()
                    ->create([
                        'name' => $user->name,
                        'staff_id' => $user->id,
                    ]);
            });
    }
}
