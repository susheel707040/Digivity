<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;

class LeaveStatusRecord extends Record
{
    protected $table="attendance_leave_status_record";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'leave_id',
        'reason',
        'status',
        'user_id'
    ];
}
