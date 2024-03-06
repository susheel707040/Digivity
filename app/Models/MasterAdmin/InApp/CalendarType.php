<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\Record;

class CalendarType extends Record
{
    protected $table="inapp_calendar_type";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'branches_id',
        'priority',
        'calendar_type',
        'color',
        'status',
        'user_id'
    ];
}
