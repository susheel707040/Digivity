<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeHeadInstallment extends Record
{
    protected $table = "finance_fee_head_instalment";
    protected $fillable = [
        'financial_id',
        'pay_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'pay_type',
        'instalment_id',
        'instalment_unique_id',
        'print_name',
        'start_date',
        'end_date',
        'fine_apply',
        'concession_type',
        'concession',
        'custom_fee_id',
        'sequence',
        'user_id'
    ];

    public function feehead()
    {
        return $this->belongsTo(FeeHead::class,'fee_head_id','id');
    }
}
