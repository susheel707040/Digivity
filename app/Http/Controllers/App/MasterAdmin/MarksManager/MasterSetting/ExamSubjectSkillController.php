<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamSubjectSkillRequest;
use App\Models\MasterAdmin\MarksManager\ExamSubjectSkill;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamSubjectSkillController extends Controller
{
    public function index()
    {
        $subjectskill=(new MarksManagerRepositories())->examsubjectskilllist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-subject-skill',compact(['subjectskill']));
    }

    public function store(ExamSubjectSkillRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamSubjectSkill::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamSubjectSkill $examsubjectskill)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-subject-skill',compact(['examsubjectskill']));
    }

    public function modify(ExamSubjectSkill $examsubjectskill,ExamSubjectSkillRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamSubjectSkill/' . $examsubjectskill->id . '/edit']);
            $examsubjectskill->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
