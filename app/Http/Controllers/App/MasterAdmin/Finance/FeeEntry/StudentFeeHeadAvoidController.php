<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class StudentFeeHeadAvoidController extends Controller
{
    public function index($studentid, $feeuptodate, $feepayid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        $studentfeestructure = studentfeerecord(studentparameter($student), $feeuptodate, $feepayid, $other = null);
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.student-fee-head-avoid', compact(['studentid', 'student','studentfeestructure']));
    }

    public function store(StudentRecord $studentrecord,Request $request)
    {
        if(isset($request["fee_head_id_avoid"])){
            $feeheadgroupid=implode(",",$request["fee_head_id_avoid"]);
        }else{
            $feeheadgroupid=null;
        }
        $studentrecord->update(['fee_head_id_avoid'=>$feeheadgroupid]);
        return back()->with('success','Fee Head Avoid Successful Complete');
    }

    public function remove(StudentRecord $studentrecord)
    {
        $studentrecord->update(['fee_head_id_avoid'=>null]);
        return back()->with('success','Fee Head Avoid Remove Successful Complete');
    }
}
