<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class LibraryGenre extends Record
{
    protected $table = "library_genre";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'genre',
        'alias',
        'book_type',
        'audience',
        'description',
        'user_id'
    ];
}
