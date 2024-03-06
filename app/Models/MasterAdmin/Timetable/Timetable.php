<?php

namespace App\Models\MasterAdmin\Timetable;

use App\Models\Record;

class Timetable extends Record
{
    protected $table = "timetable_list";
    protected $fillable = [
        'school_id',
        'branches_id',
        'academic_id',
        'timetable',
        'default_at',
        'user_id'
    ];
}
