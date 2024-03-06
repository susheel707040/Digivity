<?php

namespace App\Models\MasterAdmin\GlobalSetting;
use App\Models\Record;

class SchoolBoard extends Record
{
    protected  $table="school_boards";
    protected $fillable = [
        'school_id',
        'branches_id',
        'board_name',
        'default_at',
        'deleted_at',
    ];

}
