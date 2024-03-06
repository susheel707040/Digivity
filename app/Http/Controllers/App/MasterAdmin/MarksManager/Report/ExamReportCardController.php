<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class ExamReportCardController extends Controller
{
    public function index(Request $request)
    {
        $student =[];
        if(isset($request->course_section_id)){
            $course=explode("@",$request->course_section_id);
            $student=(new StudentRepository())->studentshortlist(['course_id'=>$course[0],'section_id'=>$course[1]]);
        }
        return view('app.erpmodule.MasterAdmin.MarksManager.Report.exam-report-card',compact(['student']));
    }

    public function print(Request $request)
    {
        if(isset($request->studentids)&&(isset($request->examterm))) {
            $examtermid = $request->examterm;
            $studentids = explode(",", $request->studentids);
            $student = (new StudentRepository())->studentshortlist(['customsearch' => ['whereIn' => ['student_id' => $studentids]]]);
        }
        return view('app.erpmodule.MasterAdmin.MarksManager.Report.exam-report-card-print',compact(['student','examtermid']));
    }
}
