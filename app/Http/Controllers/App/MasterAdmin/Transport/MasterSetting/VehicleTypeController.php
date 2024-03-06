<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\VehicleTypeRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicletype=VehicleType::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.define-vehicle-type',compact('vehicletype'));
    }

    public function store(VehicleTypeRequest $request)
    {
        session(['keyid' => 'addModels','url'=>'0']);
        VehicleType::create($request->validated());
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(VehicleType $vehicletype)
    {
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-vehicle-type',compact('vehicletype'));
    }

    public function modify(VehicleType $vehicletype,VehicleTypeRequest $request)
    {
        $vehicletype->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/Transport/EditViewVehicleType/'.$vehicletype->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
