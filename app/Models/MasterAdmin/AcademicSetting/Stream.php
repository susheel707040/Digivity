<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Stream extends Record
{
    protected $table="streams";
    protected $fillable=[
        'school_id',
        'branches_id',
        'stream',
        'default_at',
        'user_id',
    ];
}
