<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class Document extends Record
{
    protected $table = "staff_document";
    protected $fillable = [
        'school_id',
        'branches_id',
        'document_name',
        'fill_mandatory',
        'status',
        'default_at',
        'user_id'
    ];
}
