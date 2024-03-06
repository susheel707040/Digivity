<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class Vehicle extends Record
{
    protected $table="transport_vehice";
    protected $fillable=[
        'school_id',
        'branches_id',
        'vehicle_type_id',
        'vehicle_name',
        'registration_no',
        'registration_date',
        'no_of_seat',
        'max_allow',
        'mileage_km',
        'fuel_type',
        'owner_name',
        'mobile_no',
        'user_id'
    ];


    public function vehicletype()
    {
        return $this->belongsTo(VehicleType::class,'vehicle_type_id','id');
    }
}
