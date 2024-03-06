<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\ParishRequest;
use App\Models\MasterAdmin\AcademicSetting\Parish;
use App\Models\MasterAdmin\AcademicSetting\Religion;
use Illuminate\Http\Request;

class ParishController extends Controller
{
    public function index()
    {
        $parish=Parish::query()->with('religions')->record()->get();
        $religion=Religion::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-parish',compact(['parish','religion']));
    }

    public function store(ParishRequest $request)
    {
        Parish::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Create Successful Complete');

    }

    public function editview(Parish $parish)
    {
        $religion=Religion::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-parish',compact(['parish','religion']));
    }

    public function modify(Parish $parish,ParishRequest $request)
    {
        $parish->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewParish/'.$parish->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}

