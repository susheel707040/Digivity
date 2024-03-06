<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\AdmissionTypeRequest;
use App\Models\MasterAdmin\AcademicSetting\AdmissionType;
use Illuminate\Http\Request;

class AdmissionTypeController extends Controller
{
    public function index()
    {
        $admissiontype = AdmissionType::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-admission-type', compact('admissiontype'));
    }

    public function store(AdmissionTypeRequest $request)
    {
        AdmissionType::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(AdmissionType $admissiontype)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-admission-type', compact('admissiontype'));
    }

    public function modify(AdmissionType $admissiontype, AdmissionTypeRequest $request)
    {
        $admissiontype->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/GlobalSetting/EditViewAdmissionType/' . $admissiontype->id . '/edit']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
