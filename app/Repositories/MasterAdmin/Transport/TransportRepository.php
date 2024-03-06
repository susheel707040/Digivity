<?php


namespace App\Repositories\MasterAdmin\Transport;


use App\Models\MasterAdmin\Transport\MasterSetting\Route;
use App\Models\MasterAdmin\Transport\MasterSetting\RouteRelation;
use App\Models\MasterAdmin\Transport\MasterSetting\RouteStop;
use App\Models\MasterAdmin\Transport\MasterSetting\Vehicle;
use App\Models\MasterAdmin\Transport\MasterSetting\VehicleType;
use App\Repositories\MasterAdmin\RepositoryContract;

class TransportRepository extends RepositoryContract
{
    public function routelist()
    {
        return Route::query()->record()->get();
    }

    public function routestoplist()
    {
        return RouteStop::query()->record()->get();
    }

    public function vehicletypelist($search=null)
    {
        return VehicleType::query()->record()->get();
    }

    public function vehiclelist()
    {
       return Vehicle::query()->record()->get();
    }

    public function routerelationlist()
    {
        return RouteRelation::query()->record()->with(['route','routestop','vehicle'])->get();
    }

    public function routeRelationHashMap($delimiter="@") {
        $routeRelation = $this->routerelationlist();
        $relationMap = [];
        foreach($routeRelation as $relation_index => $route) {
            $relationMapKey =  strtolower(trim($route->route->route) . $delimiter . trim($route->routestop->route_stop));
            $relationMap[$relationMapKey] = $route->id;
        }
        return $relationMap;
    }
}
