<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeAccount extends Record
{
    protected $table = "finance_fee_account";
    protected $fillable = [
        'school_id',
        'branches_id',
        'financial_id',
        'fee_account',
        'default_at',
        'user_id'
    ];
}
