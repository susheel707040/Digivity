<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamMarksRecord extends Record
{
    protected $table = "exam_marks_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'student_id',
        'exam_term_id',
        'exam_type_id',
        'integrate',
        'exam_assessment_id',
        'subject_id',
        'skill_id',
        'remark',
        'marks',
        'marking_type',
        'attend_status',
        'user_id'
    ];
}
