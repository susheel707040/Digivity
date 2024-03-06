<?php

namespace App\Models\MasterAdmin\Library;

use App\Models\Record;

class Library extends Record
{
    protected $table = "library";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'library_name',
        'alias',
        'address',
        'incharge',
        'description',
        'default_at',
        'user_id'
    ];

    /*
     * Library Relation Tables Value Return
     */

    public function InChargeName()
    {
        return null;
    }

}
