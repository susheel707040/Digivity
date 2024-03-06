<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class FeeDefaulterReportController extends Controller
{
    public function classwisefeedefaulter(Request $request)
    {
        $search=[];
        if(isset($request->course_id)){$search['course_id']=$request->course_id;}
        if(isset($request->section_id)){$search['section_id']=$request->section_id;}
        $student = (new StudentRepository())->studentshortlist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.class-wise-student-fee-defaulter', compact(['student']));
    }

    public function acledgerfeedefaulter(Request $request)
    {

        $acledger=(new FinanceRepository())->studentacledgerlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.Report.ac-ledger-student-fee-defaulter',compact(['acledger']));
    }

    public function feeheadfeedefaulter(Request $request)
    {
        $search=[];
        if($request->fee_head_id){$search['id']=$request->fee_head_id;}
        $student = (new StudentRepository())->studentshortlist($request->all());
        $feehead=(new FinanceRepository())->feeheadlist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.student-fee-head-fee-defaulter',compact(['feehead','student']));
    }

    public function siblingfeedefaulter(Request $request)
    {
        $studentgroup =[];
          if($request->all()) {
              /*
              * Student Group List
              */
              $studentgroup = StudentRecord::query()->with(['course', 'section', 'student'])->record()->get()->groupBy(function ($value) use ($request) {
                  if (isset($request->sibling_group) && ($request->sibling_group == "yes")) {
                      return $value->id;
                  }
                  $groupval = [];
                  if (isset($request->contact_group) && ($request->contact_group == "yes")) {
                      $groupval[] = $value->student->contact_no;
                  }

                  if (isset($request->father_group) && ($request->father_group == "yes")) {
                      $groupval[] = $value->student->father_name;
                  }
                  if (isset($request->mother_group) && ($request->mother_group == "yes")) {
                      $groupval[] = $value->student->mother_name;
                  }
                  return implode("@", $groupval);
              });
          }

        return view('app.erpmodule.MasterAdmin.Finance.Report.sibling-fee-defaulter-report',compact(['studentgroup']));
    }

}
