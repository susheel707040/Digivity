<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\Record;
use App\Models\User;

class Assignment extends Record
{
    protected $table = "inapp_assignment_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'type',
        'course_id',
        'section_id',
        'student_id',
        'subject_id',
        'staff_id',
        'assignment_date',
        'assigned_date',
        'submitted_date',
        'assignment_title',
        'assignment',
        'show_date_time',
        'end_date_time',
        'with_app',
        'with_text_sms',
        'with_email',
        'with_website',
        'status',
        'user_id'
    ];

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
        return $this->hasMany(AssignmentAttachmentFile::class,'assignment_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * model relation define functions
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

    public function StudentName()
    {
        try{
            return null;
        }catch (\Exception $e){
            return null;
        }
    }

    public function StaffName()
    {
        try{
            return null;
        }catch (\Exception $e){
            return null;
        }
    }




}
