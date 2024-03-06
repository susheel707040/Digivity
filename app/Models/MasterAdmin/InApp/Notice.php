<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Staff\StaffRecord;
use App\Models\Record;
use App\Models\User;

class Notice extends Record
{
    protected $table = "inapp_notice_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'type',
        'course_id',
        'section_id',
        'department_id',
        'designation_id',
        'student_id',
        'staff_id',
        'notice_date',
        'notice_title',
        'notice',
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

    public function student()
    {
        return $this->belongsTo(StudentRecord::class,'student_id','student_id');
    }

    public function staff()
    {
        return $this->belongsTo(StaffRecord::class,'staff_id','id');
    }
    public function attachment()
    {
        return $this->hasMany(NoticeAttachmentFile::class,'notice_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /*
     * Relation table  Function define
     */

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
        return null;
    }

    public function TeacherName()
    {
        return null;
    }

}
