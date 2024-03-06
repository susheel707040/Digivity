<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\ReceiptCancelRequest;
use App\Models\MasterAdmin\Finance\ReceiptCancelRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FeeReceiptCancelController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.fee-receipt-cancel');
    }

    public function indexsearch($receiptno)
    {
        $feecollection = collect((new FinanceRepository())->feecollectionfulllist(['receipt_id' => $receiptno]))->first();
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.fee-receipt-cancel', compact(['feecollection']));
    }

    public function store(StudentFeeCollection $feecollection, ReceiptCancelRequest $request)
    {
        $data=$request->validated();
        $data['receipt_id']=$feecollection->id;
        $receiptcancel=ReceiptCancelRecord::create($data);
        if($receiptcancel){
            $feecollection->update(['receipt_status'=>$request->receipt_status]);
            if($feecollection){
                return back()->with('success','Fee Receipt Cancel Successful Complete');
            }
        }
        return back()->with('danger','Sorry Request failed, Please try again');
    }

}
