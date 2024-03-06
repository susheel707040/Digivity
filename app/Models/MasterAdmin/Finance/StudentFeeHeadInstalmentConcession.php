<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class StudentFeeHeadInstalmentConcession extends Record
{
    protected $table="finance_student_fee_head_instalment_concession";
    protected $fillable=[
        'financial_id',
        'student_id',
        'fee_head_id',
        'foreign_fee_head_id',
        'instalment_id',
        'concession_type',
        'concession',
        'fee_collection_id',
        'adjust_date',
        'adjust_status',
        'user_id'
    ];
}
