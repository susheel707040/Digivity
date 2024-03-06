<?php

namespace App\Models;

class Navbar extends Record
{
    protected $table="navbar";
    protected $fillable=[
        'school_id',
        'branches_id',
        'sequence',
        'for',
        'parent_id',
        'key',
        'value',
        'operation',
        'description',
        'icon',
        'link',
        'default_value',
        'status'
    ];
}
