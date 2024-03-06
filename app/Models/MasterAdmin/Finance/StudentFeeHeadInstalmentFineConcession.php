<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class StudentFeeHeadInstalmentFineConcession extends Record
{
    protected $table="finance_student_fee_head_fine_concession";
    protected $fillable=[
        'financial_id',
        'student_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'instalment_id',
        'instalment_avoid',
        'concession_type',
        'concession',
        'user_id'
    ];
}
