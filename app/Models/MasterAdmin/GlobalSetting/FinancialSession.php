<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class FinancialSession extends Record
{
    protected $fillable=[
        'school_id',
        'branches_id',
        'financial_session',
        'start_date',
        'end_date',
        'default_at',
        'updated_at',
    ];
}
