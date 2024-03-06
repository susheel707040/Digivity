<?php

namespace App\Http\Controllers\APP\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\ReligionRequest;
use App\Models\MasterAdmin\AcademicSetting\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public function index()
    {
        $religion=Religion::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-religion',compact('religion'));
    }

    public function store(ReligionRequest $request)
    {
        Religion::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(Religion $religion)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-religion',compact('religion'));
    }

    public function modify(Religion $religion,ReligionRequest $request)
    {
        $religion->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewReligion/'.$religion->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
