<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Wing extends Record
{
    protected $fillable = [
        'school_id',
        'branches_id',
        'wing',
        'default_at',
    ];
}
