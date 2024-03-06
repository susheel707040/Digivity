<?php


namespace App\Helper;


class MyHelp
{
    public static function str_replace($data,$text)
    {
    return str_replace(array_keys($data),array_values($data),$text);
    }

}
