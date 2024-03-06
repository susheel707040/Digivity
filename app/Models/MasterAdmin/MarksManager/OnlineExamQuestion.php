<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class OnlineExamQuestion extends Record
{
    protected $table = "exam_online_exam_question";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'exam_id',
        'course_id',
        'section_id',
        'question_title_id',
        'question',
        'marks',
        'question_type',
        'question_input',
        'file',
        'is_active',
        'user_id'
    ];
}
