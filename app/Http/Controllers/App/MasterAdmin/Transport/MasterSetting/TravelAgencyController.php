<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\TravelAgencyRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\TravelAgency;
use Illuminate\Http\Request;

class TravelAgencyController extends Controller
{
    public function index()
    {
        $travelagency=TravelAgency::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.define-travel-agency',compact('travelagency'));
    }

    public function store(TravelAgencyRequest $request)
    {
        session(['keyid' => 'addModels','url'=>'0']);
        TravelAgency::create($request->validated());
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(TravelAgency $travelagency)
    {
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-travel-agency',compact('travelagency'));
    }

    public function modify(TravelAgency $travelagency,TravelAgencyRequest $request)
    {
        $travelagency->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/Transport/EditViewTravelAgency/'.$travelagency->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
