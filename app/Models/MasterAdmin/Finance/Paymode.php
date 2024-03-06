<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class Paymode extends Record
{
    protected $table="finance_paymode";
    protected $fillable=[
        'school_id',
        'branches_id',
        'paymode',
        'default_at',
        'user_id'
    ];
}
