<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamGradeSystemRequest;
use App\Models\MasterAdmin\MarksManager\ExamGradeSystem;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamGradeSystemController extends Controller
{
    public function index()
    {
        $gradesystem=(new MarksManagerRepositories())->examgradesystemlist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-grading-system',compact(['gradesystem']));
    }

    public function store(ExamGradeSystemRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            $data=$request->all();
            $gradeinput=$request->except(['_token','position','grade_title','description']);
            $data=array_merge($data,['grade_input'=>serialize($gradeinput)]);
            ExamGradeSystem::create($data);
            return back()->with('success', 'Record Save Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamGradeSystem $examgradesystem)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-grading-system',compact(['examgradesystem']));
    }

    public function modify(ExamGradeSystem $examgradesystem,ExamGradeSystemRequest $request)
    {
        try {
            $data=$request->all();
            $gradeinput=$request->except(['_token','position','grade_title','description']);
            $data=array_merge($data,['grade_input'=>serialize($gradeinput)]);
            $examgradesystem->update($data);
            return back()->with('success', 'Record Update Successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
