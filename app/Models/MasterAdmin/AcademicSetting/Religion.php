<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Religion extends Record
{
    protected $table="religions";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'religion',
        'default_at',
        'user_id'
    ];
}
