<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class SubjectMapWithCourse extends Record
{
    protected $table="subject_map_with_course";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'subject_id',
        'user_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }
}
