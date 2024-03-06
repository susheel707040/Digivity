<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamTerm extends Record
{
    protected $table = "exam_term";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'position',
        'exam_term',
        'alias',
        'description',
        'is_active',
        'user_id'
    ];
}
