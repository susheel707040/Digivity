<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\HouseRequest;
use App\Models\MasterAdmin\AcademicSetting\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        $house=House::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-house',compact('house'));
    }

    public function store(HouseRequest $request)
    {
        House::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(House $house)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-house',compact('house'));
    }

    public function modify(House $house,HouseRequest $request)
    {
        $house->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewHouse/'.$house->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
