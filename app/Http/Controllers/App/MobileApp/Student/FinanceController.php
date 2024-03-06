<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceFeeCollectionRepository;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function report($studentid)
    {
        $currentdate=Carbon::now()->toDateString();
        $student=collect((new StudentRepository())->studentshortlist(['student_id'=>$studentid]))->first();
        /**
         * Student Fee Structure
         */
        $feestructurearr=array();
        $feestructure=(new FinanceFeeCollectionRepository())->studentfeerecord(studentparameter($student),$currentdate,null);
        foreach ($feestructure[0] as $data){
            if(count($data['select_pay_instalment_print'])) {
                $feestructurearr[] = ['fee_id' => $data['fee_structure_id'], 'fee_name' => $data['fee_head'],
                    'fee_instalment' => implode(",", $data['select_pay_instalment_print']),
                    'fee_amt' => ((array_sum($data['select_pay_instalment_amount'])))];
            }
        }
        /**
         * Student Paid Fee
         */
        $studentpaidreceipt=array();
        $feecollection=(new FinanceRepository())->feecollectionfulllist(['student_id'=>$studentid]);
        foreach ($feecollection as $data){
            $studentpaidreceipt[]=['receipt_id'=>$data->id,'receipt_no'=>$data->receipt_id,'receipt_date'=>Carbon::createFromDate($data->receipt_date)->format('d-M-Y'),'fee_payable'=>numberformat($data->fee_payable),'fee_paid'=>numberformat($data->paid_amount),'fee_balance'=>numberformat($data->balance)];
        }

        return response()->json([
            'result'=>1,
            'message'=>'fee record found',
            'success'=>[[
                'school_fee'=>$feestructurearr,
                'paid_receipt'=>$studentpaidreceipt
            ]]
        ],200);
    }
}
