<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class CommunicationType extends Record
{
    protected $table="communication_type";
    protected $fillable=[
        'school_id',
        'branches_id',
        'communication_type',
        'default_at',
        'user_id'
    ];

}
