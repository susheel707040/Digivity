<?php

namespace App\Models\MasterAdmin\Admission;

use App\Models\Record;

class StudentDocumentRecord extends Record
{
    protected $table = "student_document_record";
    protected $fillable = [
        'student_id',
        'document_id',
        'document_name',
        'document_no',
        'document_file',
        'user_id'
    ];
}
