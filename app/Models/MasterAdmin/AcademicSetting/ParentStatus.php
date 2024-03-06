<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class ParentStatus extends Record
{
    protected $table = "parent_status";
    protected $fillable = [
        'school_id',
        'branches_id',
        'parent_status',
        'default_at',
        'user_id'
    ];
}
