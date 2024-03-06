<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamTermRequest;
use App\Models\MasterAdmin\MarksManager\ExamTerm;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamTermController extends Controller
{
    public function index()
    {
        $examterm=(new MarksManagerRepositories())->examtermlist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-exam-term', compact(['examterm']));
    }

    public function store(ExamTermRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamTerm::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamTerm $examterm)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-exam-term', compact(['examterm']));
    }

    public function modify(ExamTerm $examterm,ExamTermRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamTerm/' . $examterm->id . '/edit']);
            $examterm->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
