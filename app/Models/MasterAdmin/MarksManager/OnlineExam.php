<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\Record;
use App\User;

class OnlineExam extends Record
{
    protected $table = "exam_online_exam";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'exam_name',
        'exam_type',
        'start_date',
        'end_date',
        'duration',
        'subject_id',
        'course_id',
        'marks',
        'pass_marks',
        'exam_format',
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

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    //Relation table Column Function
    public function SubjectName()
    {
        try {
            return $this->subject->subject_name;
        }catch (\Exception $e){
            return null;
        }
    }

    public function CourseName()
    {
        try {
            return $this->course->course;
        }catch (\Exception $e){}
    }

}
