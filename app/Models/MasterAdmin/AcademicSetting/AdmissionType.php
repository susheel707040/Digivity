<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class AdmissionType extends Record
{
    protected $table="admission_types";
    protected $fillable=[
        'school_id',
        'branches_id',
        'admission_type',
        'default_at',
        'user_id'
    ];
}
