<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\ParentStatusRequest;
use App\Models\MasterAdmin\AcademicSetting\ParentStatus;
use Illuminate\Http\Request;

class ParentStatusController extends Controller
{
    public function index()
    {
        $parentstatus = ParentStatus::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-parents-status', compact('parentstatus'));
    }

    public function store(ParentStatusRequest $request)
    {
        ParentStatus::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(ParentStatus $parentstatus)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-parent-status', compact('parentstatus'));
    }

    public function modify(ParentStatus $parentstatus, ParentStatusRequest $request)
    {
        $parentstatus->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/GlobalSetting/EditViewParentStatus/' . $parentstatus->id . '/edit']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
