<?php

namespace App\Models;


class BookmarksLinkCategory extends Record
{
    protected $table = "bookmarks_category";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'bookmarks_category',
        'user_id'
    ];
}
