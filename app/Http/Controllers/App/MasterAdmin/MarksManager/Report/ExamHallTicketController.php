<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class ExamHallTicketController extends Controller
{
    public function index(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.MarksManager.Report.student-exam-hall-ticket',compact(['student']));
    }

    public function print($studentids)
    {
        $student=[];
        $studentids=explode(",",$studentids);
        if($studentids) {
            $student = (new StudentRepository())->studentshortlist(['customsearch' => ['whereIn' => ['student_id' => $studentids]]]);
        }
        return view('app.erpmodule.MasterAdmin.MarksManager.Report.student-hall-ticket-print',compact(['student']));
    }
}
