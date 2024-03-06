<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\StaffQualificationRequest;
use App\Models\MasterAdmin\Staff\StaffQualification;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffQualificationController extends Controller
{
    public function index()
    {
        $qualification=(new StaffRepositories())->staffqualificationlist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-qualification',compact(['qualification']));
    }

    public function store(StaffQualificationRequest $request)
    {
        StaffQualification::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    // public function editview($qualification)
    // {
    //     $addUser =StaffQualification::find($qualification);
    //     return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.Edit.edit-qualification',compact(['addUser']));
    // }

    public function modify(StaffQualification $qualification,StaffQualificationRequest $request)
    {
        // return 'ok';
        $qualification->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewQualification/' . $qualification->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
