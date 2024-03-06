<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Subject extends Record
{
    protected $table="subject";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'subject_name',
        'subject_code',
        'priority',
        'status',
        'user_id'
    ];
}
