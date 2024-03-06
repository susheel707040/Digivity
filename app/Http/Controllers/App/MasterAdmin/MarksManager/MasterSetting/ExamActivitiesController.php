<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamActivitiesRequest;
use App\Models\MasterAdmin\MarksManager\ExamActivities;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamActivitiesController extends Controller
{
    public function index()
    {
        $examactivities=(new MarksManagerRepositories())->examsubjectlist(['integrate'=>'activities','define'=>'none']);
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.define-exam-category-activities', compact(['examactivities']));
    }

    public function editview(ExamActivities $examactivities)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Edit.edit-category-activities', compact(['examactivities']));
    }

}
