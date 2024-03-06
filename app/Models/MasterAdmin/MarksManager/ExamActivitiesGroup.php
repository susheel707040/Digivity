<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamActivitiesGroup extends Record
{
    protected $table = "exam_activities_group";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'activity_group',
        'description',
        'printable',
        'is_default',
        'user_id'
    ];
}
