<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;
use Illuminate\Notifications\Notifiable;

class StudentAttendance extends Record
{
    use Notifiable;

    protected $table="attendance_student_record";
    protected $fillable=[
      'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'student_id',
        'attendance_date',
        'attendance',
        'user_id'
    ];
}
