<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamSubjectSkillGroup extends Record
{
    protected $table = "exam_subject_skill_group";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'position',
        'skill_group_name',
        'description',
        'print',
        'is_active',
        'user_id'
    ];
}
