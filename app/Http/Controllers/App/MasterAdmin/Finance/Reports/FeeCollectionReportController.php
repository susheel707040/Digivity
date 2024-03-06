<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class FeeCollectionReportController extends Controller
{
    public function index(Request $request)
    {
        $feecollection= StudentFeeCollection::query()->search($request->all())->whereBetween('receipt_date',[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')])->with(['feeheadrecord','feeheadinstalmentfull','paymode','student'])->record()->orderBy('id','desc')->get();
        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-collection-report',compact(['feecollection','request']));
    }

    public function dailyfeecollectionfull(Request $request)
    {
        $feecollection= StudentFeeCollection::query()->search($request->all())->whereBetween('receipt_date',[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')])->with(['feeheadrecord','feeheadinstalmentfull','paymode','student'])->record()->orderBy('receipt_date','asc')->get()->groupBy('receipt_date');
        return view('app.erpmodule.MasterAdmin.Finance.Report.daily-fee-collection-head-paymode-wise-report',compact(['feecollection','request']));

    }

    public function studentconslidatedreport(Request $request)
    {
        $feecollection= StudentFeeCollection::query()->search($request->all())->where(['receipt_status'=>'paid'])->whereBetween('receipt_date',[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')])->with(['feeheadrecord','feeheadinstalmentfull','paymode','student'])->record()->orderBy('receipt_date','asc')->get()->groupBy('receipt_date');
        return view('app.erpmodule.MasterAdmin.Finance.Report.headwise-student-wise-consolidated-report',compact(['feecollection','request']));

    }

    public function daybookreport(Request $request)
    {
        $paymode=(new FinanceRepository())->paymodelist([]);
        $feehead=(new FinanceRepository())->feeheadlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.Report.day-book-collection-report',compact(['paymode','feehead']));
    }

    public function feeheadcollection(Request $request)
    {
        $search=[];
        if(isset($request->fee_head_id)){
            $search=['id'=>$request->fee_head_id];
        }
        $bladesearch=['receipt_status'=>'paid'];
        if(isset($request->paymode_id)&&($request->paymode_id)){
            $bladesearch=array_merge($bladesearch,['paymode_id'=>$request->paymode_id]);
        }
        $feehead=(new FinanceRepository())->feeheadlist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-head-collection-report',compact(['feehead','bladesearch']));
    }

    public function feeheadinstalmentcollection(Request $request)
    {
        /*
         * Create Search Query for Search
         */
        $feeheadsearch=[];
        if(isset($request->fee_head_id)){
            $feeheadsearch=array_merge($feeheadsearch,['id'=>$request->fee_head_id]);
        }
        $instalmentsearch=[];
        if(isset($request->instalment_id)){
            $instalmentsearch=array_merge($instalmentsearch,['instalment_id'=>$request->instalment_id]);
        }
        $bladesearch=['receipt_status'=>'paid'];
        if(isset($request->paymode_id)&&($request->paymode_id)){
            $bladesearch=array_merge($bladesearch,['paymode_id'=>$request->paymode_id]);
        }
        if(isset($request->course_id)&&($request->course_id)){
            $bladesearch=array_merge($bladesearch,['course_id'=>$request->course_id]);
        }
        if(isset($request->section_id)&&($request->section_id)){
            $bladesearch=array_merge($bladesearch,['section_id'=>$request->section_id]);
        }

        $feehead=(new FinanceRepository())->feeheadlist($feeheadsearch);
        $feeheadinstalmentgroup=(new FinanceRepository())->feeheadinstalmentgrouplist($instalmentsearch);
        return view('app.erpmodule.MasterAdmin.Finance.Report.fee-head-instalment-collection-report',compact(['feehead','feeheadinstalmentgroup','bladesearch']));

    }

    public function coursefeecollection(Request $request)
    {
        $coursesearch=[];
        if(isset($request->course_id)){$coursesearch=['id'=>$request->course_id];}
        $sectionsearch=[];
        if(isset($request->section_id)){$sectionsearch=['section_id'=>$request->section_id];}
        $courselist=(new CommanDataRepository())->courseselectlist($coursesearch);
        $sectionlist=(new CommanDataRepository())->sectionlist($sectionsearch);
        return view('app.erpmodule.MasterAdmin.Finance.Report.course-wise-fee-collection-report',compact(['courselist','sectionlist']));
    }

    public function daywisefeecollection(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.Finance.Report.day-wise-collection-report');
    }

    public function monthwisefeecollection(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.Finance.Report.month-mis-collection-report');
    }

    public function paymodefeecollection(Request $request)
    {
        $search=[];
        if(isset($request->paymode_id)){
            $search=['id'=>$request->paymode_id];
        }
        $paymodelist=(new FinanceRepository())->paymodelist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.pay-mode-wise-collection-report',compact(['paymodelist']));
    }

    public function datewisepaymodefeecollection(Request $request)
    {
        $search=[];
        if(isset($request->paymode_id)){
            $search=['id'=>$request->paymode_id];
        }
        $paymodelist=(new FinanceRepository())->paymodelist($search);
        return view('app.erpmodule.MasterAdmin.Finance.Report.date-wise-paymode-fee-collection-report',compact(['paymodelist']));
    }

    public function studentfeecollectionledger(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist();
        $feehead=(new FinanceRepository())->feeheadlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.Report.student-fee-collection-ledger-report',compact(['student','feehead']));
    }

}
