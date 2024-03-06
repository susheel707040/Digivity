<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeHead extends Record
{
    protected $table="finance_fee_head";
    protected $fillable=[
        'school_id',
        'branches_id',
        'financial_id',
        'fee_head',
        'print_line_one',
        'print_line_two',
        'type',
        'refund',
        'apply',
        'priority',
        'fee_custom',
        'form_sale',
        'user_id'
    ];

    public function feeheadinstalment()
    {
        return $this->hasMany(FeeHeadInstallment::class,'fee_head_id','id')->orderBy('sequence','asc');
    }
}
