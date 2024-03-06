<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamConfiguration extends Record
{
    protected $table="exam_configuration";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'exam_type_id',
        'exam_term_id',
        'exam_assessment_id',
        'marks',
        'integrate',
        'subject_id',
        'activity_id',
        'grace',
        'convert_to_grade',
        'sum_in_total',
        'grade_id',
        'user_id'
    ];
}
