<?php

namespace App\Models\MasterAdmin\MarksManager;

use App\Models\Record;

class ExamAssessment extends Record
{
    protected $table = "exam_assessment";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'exam_term_id',
        'position',
        'exam_assessment',
        'alias',
        'marks',
        'description',
        'is_active',
        'user_id'
    ];

    public function examterm()
    {
        return $this->belongsTo(ExamTerm::class,'exam_term_id','id')->withTrashed();
    }

    /*
     * Table Relation
     */
    public function ExamTermName()
    {
        try{
            return $this->examterm->exam_term;
        }catch (\Exception $e){
            return null;
        }
    }
}
