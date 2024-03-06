<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class Author extends Record
{
    protected $table = "library_author";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'author',
        'alias',
        'description',
        'user_id'
    ];
}
