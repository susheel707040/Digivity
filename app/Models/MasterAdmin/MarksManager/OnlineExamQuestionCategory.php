<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class OnlineExamQuestionCategory extends Record
{
    protected $table = "exam_online_exam_question_category";
    protected $fillable = [
        'id',
        'exam_id',
        'question_category',
        'default',
        'user_id'
    ];
}
