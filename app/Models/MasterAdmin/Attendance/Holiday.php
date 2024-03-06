<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;

class Holiday extends Record
{
    protected $table="attendance_holiday";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'for_student',
        'for_staff',
        'holiday',
        'description',
        'symbol',
        'holiday_from_date',
        'holiday_to_date',
        'user_id'
    ];
}
