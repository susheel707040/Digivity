<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\StaffDepartmentRequest;
use App\Models\MasterAdmin\Staff\StaffDepartment;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffDepartmentController extends Controller
{
    public function index()
    {
        $staffdepartment = (new StaffRepositories())->staffdepartmentlist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-department', compact(['staffdepartment']));
    }

    public function store(StaffDepartmentRequest $request)
    {
        StaffDepartment::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(StaffDepartment $staffdepartment)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-department',compact(['staffdepartment']));
    }

    public function modify(StaffDepartment $staffdepartment, StaffDepartmentRequest $request)
    {
        $staffdepartment->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewDepartment/' . $staffdepartment->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
