<?php

namespace App\Http\Controllers\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Finance\MasterSetting\FeeReceiptSetting;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class FeeReceiptPrintController extends Controller
{
    /*
     * Fee Receipt Print
     */
    public function receiptprint($receiptid,$grouptokenid)
    {
        $receiptconfig=FeeReceiptSetting::query()->where(['config_for'=>'fee_receipt'])->record()->first();
        $feecollection=(new FinanceRepository())->feecollectionfulllist(['id'=>$receiptid]);

        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-receipt-print',compact(['receiptconfig','feecollection']));
    }

    /*
     * Fee Estimate Print
     * @param $studentid
     * @param $acledgerno
     * @param $feeuptodate
     * @param $feepayid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function feeestimateprint($studentid,$acledgerno,$feeuptodate,$feepayid)
    {
        if($acledgerno!=0){$search=['ac_ledger_no'=>$acledgerno];}else{$search=['student_id'=>$studentid];}
        $receiptconfig=FeeReceiptSetting::query()->where(['config_for'=>'fee_receipt'])->record()->first();
        $student=(new StudentRepository())->studentshortlist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-estimate-receipt-print',compact(['receiptconfig','student','feeuptodate','feepayid']));
    }

    /*
     * Fee Details Preview
     */
    public function feedetailspreview($admissionno,$acledgerno,$feeuptodate,$feepayid)
    {
        if($acledgerno!=0){$search=['ac_ledger_no'=>$acledgerno];}else{$search=['admission_no'=>$admissionno];}
        $student=(new StudentRepository())->studentshortlist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.student-fee-details-preview',compact(['student','feeuptodate','feepayid']));
    }

    public function feepreview($receiptid,$studentid,$key)
    {
        $feereceipt=(new FinanceRepository())->feecollectionfulllist(['id'=>$receiptid])->first();
        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-receipt-view',compact(['feereceipt']));
    }

    public function studentledgerpreview(Request $request)
    {
        $feemonthdate=nowdate($request->feemonthdate,'Y-m-d');
        $studentrecord = studentshortlist(['student_id' => $request->studentid])->first();
        $studentfeerecord = studentfeerecord(studentparameter($studentrecord),nowdate('','Y-m-d'),[],1);
        $instalmentdates=(new FinanceRepository())->feeinstalmentdates();
        return view('app.app.erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.student-fee-ledger-preview',compact(['studentrecord','instalmentdates','feemonthdate']));
    }
}
