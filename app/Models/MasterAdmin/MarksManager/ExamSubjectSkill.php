<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamSubjectSkill extends Record
{
    protected $table="exam_subject_skill";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'position',
        'skill_name',
        'description',
        'print',
        'is_active',
        'user_id'
    ];
}
