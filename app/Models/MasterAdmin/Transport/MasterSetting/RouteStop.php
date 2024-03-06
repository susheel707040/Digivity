<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class RouteStop extends Record
{
    protected $table="transport_route_stop";
    protected $fillable=[
        'school_id',
        'branches_id',
        'sequence',
        'stop_no',
        'route_stop',
        'longitude',
        'latitude',
        'map_api_url',
        'school_to_stop_distance',
        'stop_to_school_distance',
        'note',
        'user_id'
    ];
}
