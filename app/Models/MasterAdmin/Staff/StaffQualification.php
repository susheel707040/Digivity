<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class StaffQualification extends Record
{
    protected $table = "staff_qualification";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'qualification',
        'default_at',
        'user_id'
    ];
}
