<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamAssessmentRequest;
use App\Models\MasterAdmin\MarksManager\ExamAssessment;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamAssessmentController extends Controller
{
    public function index()
    {
        $examassessment=(new MarksManagerRepositories())->examassessmentlist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-exam-assessment', compact(['examassessment']));
    }

    public function store(ExamAssessmentRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamAssessment::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamAssessment $examassessment)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-exam-assessment', compact(['examassessment']));
    }

    public function modify(ExamAssessment $examassessment,ExamAssessmentRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamAssessment/' . $examassessment->id . '/edit']);
            $examassessment->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
