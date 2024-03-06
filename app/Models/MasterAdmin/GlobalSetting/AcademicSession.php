<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSession extends Record
{
    protected $fillable = [
        'school_id',
        'branches_id',
        'academic_session',
        'start_date',
        'end_date',
        'default_at',
        'updated_at',
    ];

}

