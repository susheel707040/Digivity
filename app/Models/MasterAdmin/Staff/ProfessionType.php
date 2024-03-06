<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class ProfessionType extends Record
{
    protected $table = "staff_profession_type";
    protected $fillable = [
        'school_id',
        'branches_id',
        'profession_type',
        'default_at',
        'user_id'
    ];
}
