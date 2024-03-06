<?php

namespace App\Http\Controllers\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiFinanceReportController extends Controller
{
    public function apifeecollectionreport(Request $request)
    {
        /*
         * Search
         */
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}
        $search=$request->all();
        if(isset($request->course_id)){
            $course=explode("@",$request->course_id);
            if(isset($course[0])){ $search=array_merge($search,['course_id'=>$course[0]]);}
            if(isset($course[1])){$search=array_merge($search,['section_id'=>$course[1]]);}
        }

        $feecollection= StudentFeeCollection::query()->search($search)->whereBetween('receipt_date',[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')])->with(['feeheadrecord','feeheadinstalmentfull','paymode','student'])->orderBy('id','desc')->get();
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.fee-collection-api-report',compact(['feecollection','form_date','to_date']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apistudentdefaulter(Request $request)
    {
        /*
         * Search
         */
        $fee_month=nowdate('','Y-m-d');
        if(isset($request->fee_month)){$fee_month=nowdate($request->fee_month,'Y-m-d');}
        $fee_head="";
        if(isset($request->fee_head)){$fee_head=$request->fee_head;}
        $zero_show="no";
        if(isset($request->balance_yes_no)){$zero_show=$request->balance_yes_no;}
        $ac_ledger=0;
        if(isset($request->account_ledger_no)){$ac_ledger=$request->account_ledger_no;}
        $student_name="";
        if(isset($request->student_name)){$student_name=$request->student_name;}
        $course_id=""; $section_id="";
        if(isset($request->course_id)&&($request->course_id)){
            $course=explode("@",$request->course_id);
            $course_id=$course[0] ? $course[0] : 0;
            $section_id=$course[1] ? $course[1] : 0;

        }
        $search=['search'=>['ac_ledger_no'=>$ac_ledger,'course_id'=>$course_id,'section_id'=>$section_id],'customsearch'=>['wherelike'=>['full_name'=>$student_name]]];

        $student=(new StudentRepository())->studentshortlist($search);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.class-wise-student-fee-defaulter',compact(['student','fee_month','fee_head','zero_show']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apidailybookreport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}

        $course=(new CommanDataRepository())->courseselectlist();
        $paymode=(new FinanceRepository())->paymodelist();
        $feehead=(new FinanceRepository())->feeheadlist([]);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-daily-book-report',compact(['form_date','to_date','course','paymode','feehead']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apipaymodereport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}

        $paymode=(new FinanceRepository())->paymodelist();
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-paymode-report',compact(['form_date','to_date','paymode']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apifeeheadcollectionreport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}

        $feehead=(new FinanceRepository())->feeheadlist([]);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-fee-head-collection-report',compact(['form_date','to_date','feehead']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apiclasssectioncollectionreport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}

        //search
        $search=[];
        if(isset($request->course_id)&&($request->course_id)){
            $coursearr=explode("@",$request->course_id);
            if(isset($coursearr[0])){$search=array_merge($search,['id'=>$coursearr[0]]);}
        }
        $course=(new CommanDataRepository())->courseselectlist($search);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-class-section-fee-collection',compact(['form_date','to_date','course']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apimonthmisreport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}

        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-month-mis-fee-collection-report',compact(['form_date','to_date']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apidaywiseconcessionreport(Request $request)
    {
        $form_date=nowdate('','d-M-Y');
        if(isset($request->from_date)){$form_date=nowdate($request->from_date,'d-M-Y');}
        $to_date=nowdate('','d-M-Y');
        if(isset($request->to_date)){$to_date=nowdate($request->to_date,'d-M-Y');}
        /*
         * Search
         */
        $search=['receipt_status'=>'paid'];
        if(isset($request->course_id)&&($request->course_id)){
            $classarr=explode("@",$request->course_id);
            if(isset($classarr[0])){$search=array_merge($search,['course_id'=>$classarr[0]]);}
            if(isset($classarr[1])){$search=array_merge($search,['section_id'=>$classarr[1]]);}
        }
        $search=array_merge($search,['customsearch'=>['whereBetween'=>['receipt_date'=>[nowdate($form_date,'Y-m-d'),nowdate($to_date,'Y-m-d')]],'whereNotIn'=>['concession_total'=>[0]]]]);
        $feecollection=(new FinanceRepository())->feecollectionfulllist($search);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-daywise-concession-report',compact(['form_date','to_date','feecollection']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }


    public function acledgerfeedefaulter(Request $request)
    {
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-ac-ledger-fee-defaulter',compact(['e']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function classconsolidatepayment(Request $request)
    {
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Finance.api-ac-ledger-fee-defaulter',compact(['e']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }


}
