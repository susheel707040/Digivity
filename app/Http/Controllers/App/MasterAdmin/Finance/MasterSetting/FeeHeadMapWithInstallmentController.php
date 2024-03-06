<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeHeadInstallmentRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHeadInstallment;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeeHeadMapWithInstallmentController extends Controller
{
    public function index()
    {
      $feeheadinstallment=(new FinanceRepository())->feeheadinstalmentlist([]);
      return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-head-map-with-installment',compact(['feeheadinstallment']));
    }

    public function store(FeeHeadInstallmentRequest $request)
    {
        $data=array();
        $installment_data=$request[$request->pay_type.'_id'];
        /**
         * remove old data
         */
        FeeHeadInstallment::query()->where(['pay_id'=>null,'fee_head_id'=>$request->fee_head_id,'custom_fee_id'=>null])->record()->forceDelete();
        foreach ($installment_data as $instalment)
        {
         $insertdata=[
             'fee_head_id'=>$request->fee_head_id,
             'foreign_fee_head_id'=>$request->fee_head_id,
             'pay_type'=>$request->pay_type,
             'instalment_id'=>$instalment,
             'instalment_unique_id'=>$instalment,
             'print_name'=>$request[$request->pay_type.'_'.$instalment.'_name'],
             'start_date'=>Carbon::createFromDate($request[$request->pay_type.'_'.$instalment.'_start_date'])->format('Y-m-d'),
             'end_date'=>Carbon::createFromDate($request[$request->pay_type.'_'.$instalment.'_end_date'])->format('Y-m-d'),
             'fine_apply'=>$request[$request->pay_type.'_'.$instalment.'_fine_apply'],
             'concession_type'=>$request[$request->pay_type.'_'.$instalment.'_discount_type'],
             'concession'=>$request[$request->pay_type.'_'.$instalment.'_discount'],
             'sequence'=>$request[$request->pay_type.'_'.$instalment.'_sequence']
         ];
         FeeHeadInstallment::create($insertdata);
        }
     return back()->with('success','Record Save Successful Complete');
    }

    public function editview()
    {

    }
}
