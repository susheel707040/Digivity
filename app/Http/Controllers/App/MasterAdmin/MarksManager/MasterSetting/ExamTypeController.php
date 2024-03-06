<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamTypeRequest;
use App\Models\MasterAdmin\MarksManager\ExamType;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function index()
    {
        $examtype = (new MarksManagerRepositories())->examtypelist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-exam-type', compact(['examtype']));
    }

    public function store(ExamTypeRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamType::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamType $examtype)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-exam-type', compact(['examtype']));
    }

    public function modify(ExamType $examtype, ExamTypeRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamType/' . $examtype->id . '/edit']);
            $examtype->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
