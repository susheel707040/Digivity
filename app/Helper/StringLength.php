<?php


namespace App\Helper;

class StringLength
{
public static function string($val,$length)
{
   return str_pad(substr($val,$length),strlen($val), 'x', STR_PAD_LEFT);
}
}
