<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class VehicleType extends Record
{
    protected $table="transport_vehicle_type";
    protected $fillable=[
        'school_id',
        'branches_id',
        'vehicle_type',
        'default_at',
        'user_id'
    ];
}
