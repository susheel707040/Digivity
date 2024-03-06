<?php

namespace App\Models\MasterAdmin\Finance\FeeSetting;

use App\Models\Record;

class FeeGroupWithMapCourse extends Record
{
    protected $table = "finance_fee_group_with_course";
    protected $fillable = [
        'financial_id',
        'fee_group_id',
        'course_id',
        'user_id'
    ];
}
