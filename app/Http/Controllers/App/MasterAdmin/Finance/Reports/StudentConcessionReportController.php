<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentConcessionReportController extends Controller
{
    public function regularconcessionreport()
    {
        $student=(new StudentRepository())->studentshortlist();
        //dd($student);
        return view('app.erpmodule.MasterAdmin.Finance.Report.ConcessionReport.student-regular-concession-report',compact(['student']));
    }
}
