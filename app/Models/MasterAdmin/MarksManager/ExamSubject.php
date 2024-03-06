<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamSubject extends Record
{
    protected $table="exam_subject";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'group_id',
        'subject_name',
        'alias',
        'subject_code',
        'description',
        'integrate',
        'is_active',
        'define',
        'user_id'
    ];

    public function subjectgroup()
    {
        return $this->belongsTo(ExamSubject::class,'group_id','id')->withTrashed();
    }

    public function SubjectActivitiesName()
    {
        try {
            return $this->subject_name;
        }catch (\Exception $e){}
        return null;
    }

    public function SubjectGroupName()
    {
        try {
           return $this->subjectgroup->subject_name;
        }catch (\Exception $e){}
        return null;
    }

}
