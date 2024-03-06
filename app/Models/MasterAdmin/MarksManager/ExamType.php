<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamType extends Record
{
    protected $table = "exam_type";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'position',
        'exam_type',
        'alias',
        'integrate',
        'description',
        'is_active',
        'user_id'
    ];
}
