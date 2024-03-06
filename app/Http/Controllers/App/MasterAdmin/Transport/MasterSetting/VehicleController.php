<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\VehicleRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\Vehicle;
use App\Models\MasterAdmin\Transport\MasterSetting\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicle=Vehicle::query()->with('vehicletype')->record()->get();
        $vehicletype=VehicleType::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.define-vehicle-details',compact(['vehicle','vehicletype']));
    }

    public function store(VehicleRequest $request)
    {
        session(['keyid' => 'addModels','url'=>'0']);
        Vehicle::create($request->validated());
        return back()->with('success','Record Save Successful Complete');

    }

    public function editview(Vehicle $vehicle)
    {
        $vehicletype=VehicleType::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-vehicle',compact(['vehicle','vehicletype']));
    }

    public function modify(Vehicle $vehicle,VehicleRequest $request)
    {
        $vehicle->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/Transport/EditViewVehicle/'.$vehicle->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
