<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\StaffDesignationRequest;
use App\Models\MasterAdmin\Staff\StaffDesignation;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffDesignationController extends Controller
{
    public function index()
    {
        $staffdesignation = (new StaffRepositories())->satffdesignationlist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-designation', compact(['staffdesignation']));
    }

    public function store(StaffDesignationRequest $request)
    {
        StaffDesignation::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(StaffDesignation $staffdesignation)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-designation', compact(['staffdesignation']));
    }

    public function modify(StaffDesignation $staffdesignation, StaffDesignationRequest $request)
    {
        $staffdesignation->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewDesignation/' . $staffdesignation->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
