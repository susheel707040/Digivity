<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\Record;
use App\Models\User;

class Syllabus extends Record
{
    protected $table="inapp_syllabus_record";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'priority',
        'course_id',
        'subject_id',
        'syllabus_title',
        'syllabus_details',
        'icon',
        'show_app',
        'show_website',
        'status',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function attachment()
    {
        return $this->hasMany(SyllabusAttachmentFile::class,'syllabus_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * Function define
     */
    public function SubjectName()
    {
        if(isset($this->subject->subject_name)){
            return $this->subject->subject_name;
        }
        return null;
    }

    public function icon()
    {
        if(isset($this->icon)) {
            return asset($this->icon);
        }
        return null;
    }

}
