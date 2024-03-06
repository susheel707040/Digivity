<?php
namespace App\Helper;

class Otp
{
public static function generate()
{
  return mt_rand(100000,999999);
}
}
