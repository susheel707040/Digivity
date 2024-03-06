<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Section extends Record
{
    protected $table="sections";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'sequence',
        'section',
        'strength',
        'default',
        'user_id'
    ];
}
