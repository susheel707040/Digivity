<?php

namespace App\Models\MasterAdmin\Staff;


use App\Models\Record;

class StaffDesignation extends Record
{
    protected $table="staff_designation";
    protected $fillable=[
        'school_id',
        'branches_id',
        'designation',
        'show_in_payroll',
        'default_at',
        'user_id'
    ];
}
