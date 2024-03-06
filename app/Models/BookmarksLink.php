<?php

namespace App\Models;


class BookmarksLink extends Record
{
    protected $table = "bookmarks_url";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'ac_user_id',
        'bookmarks_category_id',
        'position',
        'icon',
        'title',
        'alias',
        'url',
        'open_window',
        'is_active',
        'user_id'
    ];

    public function bookmarklinkcategory()
    {
        return $this->belongsTo(BookmarksLinkCategory::class,'bookmarks_category_id','id');
    }
}
