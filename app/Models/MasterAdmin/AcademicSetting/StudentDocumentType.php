<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class StudentDocumentType extends Record
{
    protected $table="student_document_type";
    protected $fillable=[
        'school_id',
        'branches_id',
        'document_type',
        'mandatory',
        'user_id'
    ];
}
