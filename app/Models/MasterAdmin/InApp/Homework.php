<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\Record;
use App\Models\User;

class Homework extends Record
{
    protected $table="inapp_homework_record";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'course_id',
        'section_id',
        'subject_id',
        'hw_date',
        'hw_title',
        'homework',
        'with_app',
        'with_text_sms',
        'with_email',
        'with_website',
        'status',
        'user_id'
    ];

    public function attachmentfile()
    {
        return $this->hasMany(HomeworkAttachmentFile::class,'homework_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function section()
    {
       return $this->belongsTo(Section::class,'section_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function attachment()
    {
        return $this->hasMany(HomeworkAttachmentFile::class,'homework_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * subject name model get data
     */
    public function SubjectName()
    {
        try {
            return $this->subject->subject_name;
        }catch (\Exception $e){
            return null;
        }
    }
    public function CourseSection()
    {
        try {
            return $this->course->course." - ".$this->section->section;
        }catch (\Exception $e){
            return null;
        }
    }
}
