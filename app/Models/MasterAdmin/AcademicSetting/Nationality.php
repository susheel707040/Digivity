<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Nationality extends Record
{
    protected $table = "nationality";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'nationality',
        'default_at',
        'user_id'
    ];
}
