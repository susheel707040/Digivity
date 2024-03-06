<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class StaffType extends Record
{
    protected $table="staff_type";
    protected $fillable=[
        'school_id',
        'branches_id',
        'staff_type',
        'is_hourly_paid',
        'show_on_erp',
        'default_at',
        'user_id'
    ];
}
