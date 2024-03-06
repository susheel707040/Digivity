<?php

namespace App\Models\MasterAdmin\Timetable;

use App\Models\Record;

class TimeTableRecord extends Record
{
    protected $table = "timetable_record";
    protected $fillable = [
        'school_id',
        'branches_id',
        'academic_id ',
        'course_id',
        'section_id',
        'timetable_id',
        'file_name',
        'file_path',
        'user_id'
    ];
}
