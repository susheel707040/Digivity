<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamSubjectMapWithCourse extends Record
{
    protected $table = "exam_subject_map_with_course";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'position',
        'subject_id',
        'skill_group_id',
        'skill_id',
        'skill_position',
        'marking_type',
        'subject_applicable',
        'user_id'
    ];

    public function subject()
    {
        return $this->belongsTo(ExamSubject::class,'subject_id','id')->withTrashed();
    }

    /**
     * Relation Tables Get Column Name
     */

    public function SubjectName()
    {
        try {
            return $this->subject->subject_name;
        }catch (\Exception $e){
            return null;
        }
    }
}
