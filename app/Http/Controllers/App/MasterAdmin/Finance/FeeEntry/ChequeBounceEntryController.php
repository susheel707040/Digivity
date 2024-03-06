<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterAdmin\Finance\Helper\CustomFeeStore;
use App\Http\Requests\MasterAdmin\Finance\ChequeBounceRequest;
use App\Models\MasterAdmin\Finance\ChequeBounceRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChequeBounceEntryController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.cheque-bounce-entry');
    }

    public function indexsearch($receiptno)
    {
        $feecollection = collect((new FinanceRepository())->feecollectionfulllist(['id' => $receiptno]))->first();
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.cheque-bounce-entry', compact(['feecollection']));
    }

    public function store(StudentFeeCollection $feecollection, $studentid, ChequeBounceRequest $request)
    {
        $data = $request->validated();
        $data['receipt_id'] = $feecollection->id;
        $data['student_id'] = $studentid;
        $checkbounce = ChequeBounceRecord::create($data);
        /*
         * cheque bounce entry
         */
        if ($checkbounce->id) {
            /*
             * fee collection status change
             */
            $feecollection->update(['receipt_status'=>'unpaid']);
            if (($request->fee_amount != 0.00) && (!empty($request->fee_amount)) && (is_numeric($request->fee_amount))) {
                $data1 = [
                    'student_' . $studentid . '_fee_head_id' => $request->fee_head_id,
                    'student_' . $studentid . '_fee_head_amount' => $request->fee_amount,
                    'student_' . $studentid . '_instalment_id' => strtolower(Carbon::createFromDate()->format('M')),
                    'student_' . $studentid . '_instalment_print' => "Cheque Bounce (Receipt:".$feecollection->id."-" .date('d-m-Y', strtotime($feecollection->receipt_date)).")",
                    'student_' . $studentid . '_start_date' => Carbon::now()->toDateString(),
                    'student_' . $studentid . '_concession_type' => "f",
                    'student_' . $studentid . '_concession' => "0",
                    'student_' . $studentid . '_priority_id' => "1",
                ];
                $customsubmit = CustomFeeStore::storefee($studentid, null, $data1);
                if ($customsubmit) {
                    return back()->with('success', 'Cheque Bounce Entry Successful Complete');
                } else {
                    return back()->with('danger', 'Sorry, Request failed, Please try again');
                }
            }
            return back()->with('success', 'Cheque Bounce Entry Successful Complete');
        } else {
            return back()->with('danger', 'Sorry, Request failed, Please try again');
        }
    }

    public function remove()
    {

    }
}
