<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\ReceiptModifyRequest;
use App\Models\MasterAdmin\Finance\ReceiptModifyRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FeeReceiptModifyController extends Controller
{
    public function index(Request $request)
    {
        $feecollection =[];
        if($request->receipt_no){
            $feecollection = collect((new FinanceRepository())->feecollectionfulllist(['receipt_id' => $request->receipt_no]))->first();
        }
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.fee-receipt-modify',compact(['feecollection']));
    }

    public function modify(StudentFeeCollection $feecollection,ReceiptModifyRequest $request)
    {
        $data=$request->validated();
        $data['receipt_id']=$feecollection->id;
        $data['receipt_date']=nowdate($request->receipt_date,'Y-m-d');
        if($request->instrument_date) {
        $data['instrument_date'] = nowdate($request->instrument_date, 'Y-m-d');
        }else{$data['instrument_date']=null;}
        /*
         * Receipt Cancel Entry
         */
        $receiptmodify=ReceiptModifyRecord::create($data);
        if($receiptmodify){
            unset($data['receipt_id']);
            unset($data['old_receipt_record']);
           if($feecollection->update($data)){
               return back()->with('success','Record Save Successful Complete');
           }
        }
        return back()->with('danger','Sorry, Request failed, Please try again');
    }
}
