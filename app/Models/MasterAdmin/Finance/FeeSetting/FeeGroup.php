<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeGroup extends Record
{
    protected $table = "finance_fee_group";
    protected $fillable = [
        'school_id',
        'branches_id',
        'financial_id',
        'fee_account_id',
        'fee_group',
        'sequence',
        'user_id'
    ];

    public function feeaccount()
    {
        return $this->belongsTo(FeeAccount::class,'fee_account_id','id');
    }
}
