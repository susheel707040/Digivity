<?php


namespace App\Helper;


use App\Models\User;

class AuthNotLogin
{
    public static function Get()
    {
        $user=User::query()->where(['role_id'=>1])->first();
        return $user;
    }
}
