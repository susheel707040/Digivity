<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class ConcessionType extends Record
{
    protected $table = "finance_concession_type";
    protected $fillable = [
        'school_id',
        'branches_id',
        'financial_id',
        'concession_type',
        'sequence',
        'user_id'
    ];
}
