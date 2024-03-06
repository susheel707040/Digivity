<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class Route extends Record
{
    protected $table = "transport_route";
    protected $fillable = [
        'school_id',
        'branches_id',
        'academic_id',
        'sequence',
        'route',
        'longitude',
        'latitude',
        'map_api_url',
        'school_to_route_distance',
        'route_to_school_distance',
        'note',
        'admission',
        'user_id'
    ];
}
