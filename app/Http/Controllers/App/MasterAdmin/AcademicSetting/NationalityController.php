<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\NationalityRequest;
use App\Models\MasterAdmin\AcademicSetting\Nationality;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        $nationality=(new CommanDataRepository())->nationalitylist([]);
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-nationality',compact('nationality'));
    }

    public function store(NationalityRequest $request)
    {
        Nationality::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(Nationality $nationality)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-nationality',compact('nationality'));
    }

    public function modify(Nationality $nationality,NationalityRequest $request)
    {
        $nationality->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewNationality/'.$nationality->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }
}
