<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\StaffTypeRequest;
use App\Models\MasterAdmin\Staff\StaffType;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffTypeController extends Controller
{
    public function index()
    {
        $stafftype = (new StaffRepositories())->stafftypelist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-staff-type', compact(['stafftype']));
    }

    public function store(StaffTypeRequest $request)
    {
        StaffType::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(StaffType $stafftype)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-staff-type',compact(['stafftype']));
    }

    public function modify(StaffType $stafftype, StaffTypeRequest $request)
    {
        $stafftype->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewStaffType/' . $stafftype->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
