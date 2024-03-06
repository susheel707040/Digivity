<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeStructureInstalment extends Record
{
    protected $table = "finance_fee_head_structure_instalment_amount";
    protected $fillable = [
        'fee_head_structure_id',
        'fee_group_id',
        'fee_head_id',
        'instalment_id',
        'fee_amount',
        'user_id'
    ];
}
