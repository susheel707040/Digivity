<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class CourseWithSection extends Record
{
    protected $table="courses_map_sections";
    protected $fillable=[
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id')->select(array('id', 'course','sequence'))->orderBy('sequence','asc');;
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id')->select(array('id', 'section','sequence'))->orderBy('sequence','asc');;
    }


    /*
     * Table Relation
     */
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
