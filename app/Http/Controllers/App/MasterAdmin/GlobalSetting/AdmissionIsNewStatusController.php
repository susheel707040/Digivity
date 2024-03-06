<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\GlobalSetting\AdmissionIsNewStatusRequest;
use App\Models\MasterAdmin\GlobalSetting\AdmissionIsNewStatus;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class AdmissionIsNewStatusController extends Controller
{
    public function index()
    {
        $admissionstatus=(new CommanDataRepository())->admissionisnewstatuslist();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-admission-is-new-status', compact('admissionstatus'));
    }

    public function store(AdmissionIsNewStatusRequest $request)
    {
        session(['keyid' => 'addModels','url'=>'0']);
        AdmissionIsNewStatus::create($request->validated());
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(AdmissionIsNewStatus $admissionisnewstatus)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-admission-is-new-status', compact('admissionisnewstatus'));
    }

    public function modify(AdmissionIsNewStatus $admissionisnewstatus,AdmissionIsNewStatusRequest $request)
    {
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/GlobalSetting/EditViewAdmissionIsNewStatus/'.$admissionisnewstatus->id.'/edit']);
        $admissionisnewstatus->update($request->validated());
        return back()->with('success','Record Update Successful Complete');
    }
}
