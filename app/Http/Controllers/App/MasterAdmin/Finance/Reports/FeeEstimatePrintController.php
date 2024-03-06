<?php

namespace App\Http\Controllers\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class FeeEstimatePrintController extends Controller
{
    public function feeestimate($feeuptodate,$feepayid,$studentids)
    {
        $studentid=explode(",",$studentids);
        $student=StudentRecord::query()->whereIn('student_id',$studentid)->record()->get();
        return view('erpmodule.MasterAdmin.Finance.Report.fee-estimate-token-print',compact(['student','feeuptodate','feepayid','studentids']));
    }
}
