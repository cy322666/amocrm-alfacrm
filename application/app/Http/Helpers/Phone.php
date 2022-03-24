<?php


namespace App\Http\Helpers;


abstract class Phone
{
    public static function clearPhone($phone = null)
    {
        if(strlen($phone) >= 10) {
            
            $phone = str_replace(['+', '-', '(', ')', '.', ' ', '  ', '-', ':'], '', $phone);
            
            if(strlen($phone) >= 11) return '+'.$phone;
            
            if(strlen($phone) == 10 || strlen($phone) < 10) return '+7'.$phone;
        }
    }
}