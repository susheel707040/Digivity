<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamActivities extends Record
{
    protected $table = "exam_activities";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'exam_type_id',
        'position',
        'exam_activity',
        'alias',
        'display',
        'is_active',
        'user_id'
    ];

    public function examtype()
    {
        return $this->belongsTo(ExamType::class,'exam_type_id','id')->withTrashed();
    }

    /*
     * Relation Table Column Function
     */

    public function ExamTypeName()
    {
        try {
            return $this->examtype->exam_type;
        }catch (\Exception $e){
            return null;
        }
    }

    public function ActivitiesName()
    {
        try {
            return $this->exam_activity;
        }catch (\Exception $e){}
    }

    public function SubjectActivitiesName()
    {
        try {
            return $this->exam_activity;
        }catch (\Exception $e){}
    }

}
