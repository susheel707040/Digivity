<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class RouteRelation extends Record
{
    protected $table="transport_route_relations";
    protected $fillable=[
        'school_id',
        'branches_id',
        'route_id',
        'route_stop_id',
        'vehicle_id',
        'driver_id',
        'morning_time',
        'afternoon_time',
        'user_id'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class,'route_id','id');
    }

    public function routestop()
    {
        return $this->belongsTo(RouteStop::class,'route_stop_id','id');
    }

    public function vehicle()
    {
       return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }

    public function routefeecharge()
    {
        return $this->hasMany(TransportRouteFeeCharge::class,'route_relation_id','id');
    }

    /**
     * string name
     */

    public function RouteName()
    {
        try {
            return $this->route->route;
        }catch (\Exception $e){}
       return null;
    }

    public function RouteStopName()
    {
        try {
            return $this->routestop->stop_no." - ".$this->routestop->route_stop;
        }catch (\Exception $e){}
        return null;
    }

    public function PickupTime()
    {
        try {
            return $this->morning_time;
        }catch (\Exception $e){}
        return null;
    }

    public function DropTime()
    {
        try {
            return $this->afternoon_time;
        }catch (\Exception $e){}
        return null;
    }

    public function VehicleTypeName()
    {
        try {
            return $this->route->route;
        }catch (\Exception $e){}
        return null;
    }

    public function VehicleName()
    {
        try {
            return $this->vehicle->vehicle_name." - ".$this->vehicle->registration_no;
        }catch (\Exception $e){}
        return null;
    }

    public function DriverName()
    {
        try {
            return  "N/A";
        }catch (\Exception $e){}
        return null;
    }

    public function DriverMobileNo()
    {
        try {
            return  "N/A";
        }catch (\Exception $e){}
        return null;
    }

    public function TransportHelpNo()
    {
        try {
            return  "N/A";
        }catch (\Exception $e){}
        return null;
    }


}
