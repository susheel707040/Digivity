<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Finance\StudentFeeHeadInstalmentAvoid;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class StudentFeeHeadInstalmentAvoidController extends Controller
{
    public function index($studentid, $feeuptodate, $feepayid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        $feeheadinstalmentavoid=(new FinanceRepository())->feeheadinstalmentavoid(['student_id'=>$studentid]);
        $studentfeestructure = studentfeerecord(studentparameter($student), $feeuptodate, $feepayid, $other = null);
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.student-fee-head-instalment-avoid', compact(['studentid', 'student', 'studentfeestructure','feeheadinstalmentavoid']));
    }

    public function store($studentid,Request $request)
    {
        StudentFeeHeadInstalmentAvoid::query()->where('student_id',$studentid)->record()->forceDelete();
        foreach ($request["fhi_".$studentid."_foreign_fee_head_id"] as $foreign_fee_head_id){
            if($request["fee_head_".$foreign_fee_head_id."_instalment_id_avoid"]) {
                $data = [
                    'student_id' => $studentid,
                    'fee_head_id' => $request["fhi_" . $foreign_fee_head_id . "_fee_head_id"],
                    'foreign_fee_head_id' => $foreign_fee_head_id,
                    'instalment_id' => implode(',',$request["fee_head_".$foreign_fee_head_id."_instalment_id_avoid"])
                ];
                StudentFeeHeadInstalmentAvoid::create($data);
            }
        }
        return back()->with('success','Fee Head Instalment Avoid Successful Complete');
    }

    public function remove()
    {

    }
}
