<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class ConcessionSetting extends Record
{
    protected $table = "finance_concession_assign_setting";
    protected $fillable = [
        'financial_id',
        'concession_type_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'instalment_id',
        'concession_type',
        'concession',
        'user_id'
    ];
}
