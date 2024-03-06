<?php

namespace App\Http\Controllers\MasterAdmin\Attendance\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class ApiAttendanceReportController extends Controller
{
    public function daywiseattendancereport(Request $request)
    {
        $from_date=nowdate($request->from_date,'d-M-Y');
        $to_date=nowdate($request->to_date,'d-M-Y');
        $search=[];
        if(isset($request->course_id)&&($request->course_id)){
            $course=explode("@",$request->course_id);
            $search=array_merge($search,['course_id'=>$course[0],'section_id'=>$course[1]]);
        }
        $student=(new StudentRepository())->studentshortlist($search);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Attendance.api-day-wise-attendance-report',compact(['from_date','to_date','student','request']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json(['result'=>1,'message'=>'data found','success'=>[['data'=>$pageview]]],200);
    }

    public function classwiseattendancereport(Request $request)
    {
        $from_date=nowdate($request->from_date,'d-M-Y');
        $to_date=nowdate($request->to_date,'d-M-Y');
        $course=(new CommanDataRepository())->courseselectlist();
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Attendance.api-course-wise-attendance-report',compact(['from_date','to_date','course']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json(['result'=>1,'message'=>'data found','success'=>[['data'=>$pageview]]],200);
    }

    public function studentmisattendancereport(Request $request)
    {
        $from_date=nowdate($request->from_date,'d-M-Y');
        $to_date=nowdate($request->to_date,'d-M-Y');
        $search=[];
        if(isset($request->course_id)&&($request->course_id)){
            $course=explode("@",$request->course_id);
            $search=array_merge($search,['course_id'=>$course[0],'section_id'=>$course[1]]);
        }
        $student=(new StudentRepository())->studentshortlist($search);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Attendance.api-student-attendance-mis-report',compact(['from_date','to_date','student']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json(['result'=>1,'message'=>'data found','success'=>[['data'=>$pageview]]],200);

    }
}
