<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\Record;

class StaffMapCourse extends Record
{
    protected $table = "staff_map_with_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'staff_id',
        'course_id',
        'section_id',
        'for_course_id',
        'for_section_id',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id')->orderBy('sequence','asc');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id')->orderBy('sequence','asc');
    }

    public function CourseName()
    {
        try {
            return $this->course->course;
        }catch (\Exception $e){}
        return null;
    }

    public function SectionName()
    {
        try {
            return $this->section->section;
        }catch (\Exception $e){}
        return null;
    }

}
