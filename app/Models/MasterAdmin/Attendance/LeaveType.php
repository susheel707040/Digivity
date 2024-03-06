<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;

class LeaveType extends Record
{
    protected $table = "attendance_leave_type";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'sequence',
        'leave_type',
        'alias',
        'description',
        'user_id'
    ];
}
