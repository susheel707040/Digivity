<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class Certificate extends Record
{
    protected $table="certificate";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'for',
        'sequence',
        'certificate_name',
        'integrate',
        'description',
        'icon',
        'status',
        'user_id'
    ];
}
