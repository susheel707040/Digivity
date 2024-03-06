<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Finance\StudentFeeHeadInstalmentFineConcession;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class StudentFeeHeadFineConcessionController extends Controller
{
    public function index($studentid, $feeuptodate, $feepayid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        $studentfeestructure = studentfeerecord(studentparameter($student), $feeuptodate, $feepayid, $other = null);
        $studentfeeheadfineconcession = (new FinanceRepository())->feeheadfineconcession(['student_id' => $studentid]);
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.student-fee-head-fine-concession', compact(['studentid', 'student', 'studentfeestructure', 'studentfeeheadfineconcession']));
    }

    public function store($studentid, Request $request)
    {
        StudentFeeHeadInstalmentFineConcession::query()->where(['student_id'=>$studentid,'adjust_status'=>'0'])->record()->forceDelete();
        if (isset($request["foreign_" . $studentid . "_fee_head_id"])) {

            foreach ($request["foreign_" . $studentid . "_fee_head_id"] as $foreign_fee_head_id) {

                foreach ($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_instalment_id"] as $instalmentid) {

                    if (($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession"] > 0) || ($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_status"] == "yes")) {

                        $data = [
                            'student_id' => $studentid,
                            'fee_head_id' => $request["fee_head_" . $studentid . "_" . $foreign_fee_head_id . "_id"],
                            'foreign_fee_head_id' => $foreign_fee_head_id,
                            'instalment_id' => $instalmentid,
                            'instalment_avoid' => $request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_status"],
                            'concession_type' => $request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession_type"],
                            'concession' => $request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession"]
                        ];
                        StudentFeeHeadInstalmentFineConcession::create($data);
                    }
                }
            }

            return back()->with('success', 'Student Fee Head Instalment Fine Concession Apply Successful Complete');

        } else {
            return back()->with('danger', 'Please Select atleast one Fee Head Fine Concession');
        }
    }

    public function remove($studentid)
    {
        StudentFeeHeadInstalmentFineConcession::query()->where(['student_id'=>$studentid,'adjust_status'=>'0'])->record()->forceDelete();
        return back()->with('success', 'Student Fee Head Instalment Fine Concession Remove Successful Complete');
    }
}
