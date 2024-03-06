<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Caste extends Record
{
    protected $table="castes";
    protected $fillable=[
        'school_id',
        'branches_id',
        'caste',
        'user_id'
    ];
}
