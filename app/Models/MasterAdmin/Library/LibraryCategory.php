<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class LibraryCategory extends Record
{
    protected $table="library_item_category";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'item_category',
        'return_day',
        'default_at',
        'sequence',
        'user_id'
    ];
}
