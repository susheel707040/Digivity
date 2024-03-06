<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class SMSConfiguration extends Record
{
    protected $table = "communication_sms_configuration";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'vendor',
        'sender_id',
        'credentials',
        'user_id'
    ];
}
