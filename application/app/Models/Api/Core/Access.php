<?php

namespace App\Models\Api\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'service_accesses';

    protected $fillable = [
        'account_id',
        'user_id',
        'service_name',
        'subdomain',
        'access_token',
        'refresh_token',
        'client_secret',
        'redirect_uri',
        'token_type',
        'expires_in',
        'api_key',
        'login',
        'password',
    ];
}
