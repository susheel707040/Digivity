<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class CommunicationBalance extends Record
{
    protected $table = "communication_balance";
    
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'month',
        'start_date',
        'end_date',
        'text_balance',
        'text_use_balance',
        'email_balance',
        'email_use_balance',
        'app_balance',
        'app_use_balance',
        'user_id'
    ];
}
