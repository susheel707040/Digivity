<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamSubjectSkillGroupRequest;
use App\Models\MasterAdmin\MarksManager\ExamSubjectSkillGroup;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamSubjectSkillGroupController extends Controller
{
    public function index()
    {
        $subjectskillgroup=(new MarksManagerRepositories())->examsubjectskillgrouplist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-subject-skill-group',compact(['subjectskillgroup']));
    }

    public function store(ExamSubjectSkillGroupRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamSubjectSkillGroup::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamSubjectSkillGroup $examsubjectskillgroup)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-subject-skill-group',compact(['examsubjectskillgroup']));
    }

    public function modify(ExamSubjectSkillGroup $examsubjectskillgroup,ExamSubjectSkillGroupRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamSubjectSkillGroup/' . $examsubjectskillgroup->id . '/edit']);
            $examsubjectskillgroup->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
