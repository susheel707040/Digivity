<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class StaffDepartment extends Record
{
    protected $table="staff_department";
    protected $fillable=[
        'school_id',
        'branches_id',
        'department',
        'default_at',
        'user_id'
    ];
}
