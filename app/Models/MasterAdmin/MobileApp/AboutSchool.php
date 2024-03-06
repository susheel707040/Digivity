<?php

namespace App\Models\MasterAdmin\MobileApp;

use App\Models\Record;

class AboutSchool extends Record
{
    protected $table="about_school_record";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'page_id',
        'body_data',
        'user_id'
    ];
}
