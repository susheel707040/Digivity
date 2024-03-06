<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;
use Illuminate\Notifications\Notifiable;

class StaffAttendance extends Record
{
    use Notifiable;

    protected $table="attendance_staff_record";
    protected $fillable=[
      'school_id',
        'branches_id',
        'academic_id',
        'designation_id',
        'department_id',
        'staff_id',
        'attendance_date',
        'attendance',
        'punch_in',
        'punch_out',
        'user_id'
    ];
}
