<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class House extends Record
{
    protected $table = "houses";
    protected $fillable = [
        'school_id',
        'branches_id',
        'house',
        'user_id'
    ];
}
