<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class FeeCollectionConcessionReport extends Controller
{
    public function index(Request $request)
    {
        $search=['search'=>$request->all()];

        $search=array_merge($search,['customsearch'=>['whereBetween'=>['receipt_date'=>[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')]],'whereNotIn'=>['concession_total'=>[0]]]]);
        $feecollection=(new FinanceRepository())->feecollectionfulllist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.ConcessionReport.fee-collection-concession-report',compact(['feecollection']));
    }

    public function concessionconslidatedreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        $feehead=(new FinanceRepository())->feeheadlist([]);
        $feeheadinstalment=[];
        foreach ($feehead as $data){
            $feeheadinstalmentgroup=(new FinanceRepository())->feeheadinstalmentgrouplist(['fee_head_id'=>$data->id]);
            $feeheadinstalment[]=['fee_head_id'=>$data->id,'instalment'=>$feeheadinstalmentgroup];
        }
        return view('app.erpmodule.MasterAdmin.Finance.Report.ConcessionReport.student-fee-collection-concession-conslidated-report',compact(['student','feehead','feeheadinstalment']));
    }
}
