<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class AdmissionIsNewStatus extends Record
{
    protected $table="admission_is_new_status";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'priority',
        'alias',
        'admission_status',
        'default_at',
        'user_id'
    ];
}
