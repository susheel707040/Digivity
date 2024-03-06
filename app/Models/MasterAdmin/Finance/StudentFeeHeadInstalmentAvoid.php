<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class StudentFeeHeadInstalmentAvoid extends Record
{
    protected $table="finance_student_fee_head_instalment_avoid";
    protected $fillable=[
        'financial_id',
        'student_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'instalment_id',
        'user_id'
    ];
}
