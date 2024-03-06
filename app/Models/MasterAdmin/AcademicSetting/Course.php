<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Course extends Record
{
    protected $fillable=[
        "id",
        "school_id",
        "branches_id",
        "wing_id",
        "sequence",
        "course",
        "course_code",
        "full_name",
        "tc_name",
        "user_id",
        "deleted_at",
    ];


    public function wing()
    {
        return $this->belongsTo(Wing::class,'wing_id','id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class,'courses_map_sections')->orderBy('sequence','asc');
    }

    public function coursewithsection()
    {
        return $this->hasMany(CourseWithSection::class,'course_id','id')->record();
    }

    /*
     * Table Relation Columan Name
     */
    public function CourseName()
    {
        try {
            return $this->coursewithsection->course->course;
        }catch (\Exception $e){}
        return null;
    }

    public function SectionName()
    {
        try {
            return $this->coursewithsection->section->section;
        }catch (\Exception $e){}
        return null;
    }

}
