<?php

namespace App\Models;

use App\Models\AlfaCRM\Setting;
use App\Models\AlfaCRM\Transaction;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function account()
    {
        return $this->hasMany(Account::class);
    }

    public function alfaAccount()
    {
        return Account::query()
            ->where('user_id', $this->id)
            ->where('name', 'alfacrm')
            ->first();
    }

    public function bizonAccount()
    {
        return Account::query()
            ->where('user_id', $this->id)
            ->where('name', 'bizon')
            ->first();
    }

    public function amoAccount()
    {
        return Account::query()
            ->where('user_id', $this->id)
            ->where('name', 'amocrm')
            ->first();
    }

    public function webhooks()
    {
        return $this->hasMany(Webhook::class);
    }

    public function alfaTransactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function alfaSetting()
    {
        return $this->hasOne(Setting::class);
    }
}
