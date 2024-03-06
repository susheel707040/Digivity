<?php


namespace App\Helper;


class GenerateTokenId
{
    public static function TokemId($length)
    {
        return mt_rand(1000000000,9999999999);
    }
}
