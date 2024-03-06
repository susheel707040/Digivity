<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class Racks extends Record
{
    protected $table = "library_item_racks";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'racks',
        'description',
        'capacity',
        'sequence',
        'user_id'
    ];
}
