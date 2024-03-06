<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamGradeSystem extends Record
{
    protected $table = "exam_grade_system";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'position',
        'grade_title',
        'description',
        'grade_input',
        'user_id'
    ];
}
