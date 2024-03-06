<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class SMSTemplate extends Record
{
    protected $table = "communication_sms_template";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'template_name',
        'sms_type',
        'is_active',
        'unicode',
        'template',
        'user_id'
    ];
}
