<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\SectionRequest;
use App\Models\MasterAdmin\AcademicSetting\Section;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class SectionController extends Controller
{
    public function index()
    {
        $section=Section::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-section',compact('section'));
    }

    public function store(SectionRequest $request)
    {
        Section::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(Section $section)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-section',compact('section'));
    }

    public function modify(Section $section,SectionRequest $request)
    {
        $section->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/GlobalSetting/EditViewSection/' . $section->id . '/edit']);
        return back()->with('success','Record Update Successful Complete');
    }

}

