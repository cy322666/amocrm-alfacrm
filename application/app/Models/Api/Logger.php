<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    public $timestamps = false;
    
    protected $table = 'logger';
    
    public function getContent($key)
    {
        return $this->$key;
    }
}