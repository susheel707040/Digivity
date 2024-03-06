<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\CasteRequest;
use App\Models\MasterAdmin\AcademicSetting\Caste;
use Illuminate\Http\Request;

class CasteController extends Controller
{
    public function index()
    {
        $caste=Caste::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-caste',compact('caste'));
    }

    public function store(CasteRequest $request)
    {
        Caste::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(Caste $caste)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-caste',compact('caste'));
    }

    public function modify(Caste $caste,CasteRequest $request)
    {
        $caste->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewCaste/'.$caste->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');

    }
}
