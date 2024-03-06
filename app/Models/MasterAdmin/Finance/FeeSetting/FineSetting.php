<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FineSetting extends Record
{
    protected $table = "finance_fine_setting";
    protected $fillable = [
        'school_id',
        'branches_id',
        'financial_id',
        'fee_group_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'instalment_id',
        'fine_type',
        'instalment_max_limit',
        'fine_max_limit',
        'user_id'
    ];
}
