<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Category extends Record
{
    protected $table="category";
    protected $fillable=[
        'school_id',
        'branches_id',
        'category',
        'default_at',
        'user_id'
    ];
}
