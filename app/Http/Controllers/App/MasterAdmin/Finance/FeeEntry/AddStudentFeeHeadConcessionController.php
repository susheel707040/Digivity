<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Finance\StudentFeeHeadInstalmentConcession;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class AddStudentFeeHeadConcessionController extends Controller
{
    public function index($studentid, $feeuptodate, $feepayid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        $studentfeestructure = studentfeerecord(studentparameter($student), $feeuptodate, $feepayid, $other = null);
        $studentfeeheadinstalmentconcession=(new FinanceRepository())->feeheadinstalmentconcession(['student_id'=>$studentid,'adjust_status'=>'0']);
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.add-student-fee-head-concession', compact(['studentid', 'student', 'studentfeestructure','studentfeeheadinstalmentconcession']));
    }

    public function store($studentid, Request $request)
    {
        if (isset($request["foreign_" . $studentid . "_fee_head_id"])) {

            StudentFeeHeadInstalmentConcession::query()->where(['student_id'=>$studentid,'adjust_status'=>'0'])->record()->forceDelete();

            foreach ($request["foreign_" . $studentid . "_fee_head_id"] as $foreign_fee_head_id) {

                if(isset($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_instalment_id"])) {
                    foreach ($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_instalment_id"] as $instalmentid) {
                        if (!empty($request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession"])) {
                            $data = [
                                'student_id' => $studentid,
                                'fee_head_id' => $request["fee_head_" . $studentid . "_" . $foreign_fee_head_id . "_id"],
                                'foreign_fee_head_id' => $foreign_fee_head_id,
                                'instalment_id' => $instalmentid,
                                'concession_type' => $request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession_type"],
                                'concession' => $request["student_" . $studentid . "_" . $foreign_fee_head_id . "_" . $instalmentid . "_concession"]
                            ];
                            StudentFeeHeadInstalmentConcession::create($data);
                        }
                    }
                }
            }
            return back()->with('success', 'Student Fee Head Instalment Concession Apply Successful Complete');
        } else {
            return back()->with('danger', 'Please Select atleast one Fee Head Concession');
        }
    }

    public function remove($studentid)
    {
        StudentFeeHeadInstalmentConcession::query()->where(['student_id'=>$studentid,'adjust_status'=>'0'])->record()->forceDelete();
        return back()->with('success', 'Student Fee Head Instalment Concession Remove Successful Complete');
    }
}
