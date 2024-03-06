<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class Tag extends Record
{
    protected $table = "library_tag";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'tag',
        'alias',
        'description',
        'user_id'
    ];
}
