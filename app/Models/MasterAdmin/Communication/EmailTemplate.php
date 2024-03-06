<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class EmailTemplate extends Record
{
    protected $table = "communication_email_template";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'template_name',
        'subject',
        'sms_type',
        'template',
        'is_active',
        'user_id'
    ];
}
