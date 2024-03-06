<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamSubjectRequest;
use App\Models\MasterAdmin\MarksManager\ExamSubject;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamSubjectController extends Controller
{
    public function subjectgroupindex()
    {
        $subjectgroup=(new MarksManagerRepositories())->examsubjectgrouplist();
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-subject-group',compact(['subjectgroup']));
    }

    public function subjectgroupview(ExamSubject $examsubject)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-subject-group', compact(['examsubject']));
    }

    public function subjectgroupmodify(ExamSubject $examsubject, ExamSubjectRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditExamViewSubjectGroup/' . $examsubject->id . '/edit']);
            $examsubject->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }



    public function index()
    {
        $subject = (new MarksManagerRepositories())->examsubjectlist(['integrate'=>'subject','define'=>'none']);
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-subject', compact(['subject']));
    }

    public function store(ExamSubjectRequest $request)
    {
        try {
            session(['keyid' => 'addModels', 'url' => 0]);
            ExamSubject::create($request->validated());
            return back()->with('success', 'Record Save Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(ExamSubject $examsubject)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-subject', compact(['examsubject']));
    }

    public function editactivityview(ExamSubject $examsubject)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-category-activities', compact(['examsubject']));
    }

    public function modify(ExamSubject $examsubject, ExamSubjectRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewExamSubject/' . $examsubject->id . '/edit']);
            $examsubject->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function activitymodify(ExamSubject $examsubject, ExamSubjectRequest $request)
    {
        try {
            session(['keyid' => 'editModels', 'url' => 'MasterAdmin/MarksManager/EditViewSubjectActivities/' . $examsubject->id . '/edit']);
            $examsubject->update($request->validated());
            return back()->with('success', 'Record Update Successful Complete.');
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
