<?php


namespace App\Helper;


use App\Models\MasterAdmin\GlobalSetting\SMSConfiguration;

class SMSConfig
{

    public static function senderid()
    {
        $smsconfig = SMSConfiguration::query()->first();
        return $smsconfig->sender_id;
    }
}
