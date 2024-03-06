<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\Reports;

use App\Helper\DBTableSum;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class StudentReportsController extends Controller
{
    public function classwisestudentlist(Request $request)
    {
        $search=$request->all();
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.define-class-wise-student-list',compact(['student']));
    }

    public function studentcredentialslist(Request $request)
    {
        $search=$request->all();
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.student-credentials-report',compact(['student']));
    }

    public function inactivestudentlist(Request $request)
    {
        $search=['status'=>'inactive'];
        $search +=$request->all();
        $student=(new StudentRepository())->studentshortlist($search);
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.inactive-student-report',compact(['student']));
    }

    public function studentdocumentreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        $document=(new CommanDataRepository())->studentdocumenttypelist();
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.student-document-submitted-report',compact(['student','document']));
    }


    /*
     * Mobile Application Api Controller
     */
    public function studentlistmobileapp($userid,Request $request)
    {
        /*
         * Generate Search Query
         */
        try {
          $search=array();
          $course=explode("@",$request->course_id);
          $course_id=$course[0];
          $section_id=$course[1];
          $search=array_merge($search,['course_id'=>$course_id,'section_id'=>$section_id]);

          //sort by method
          $sortbymethod="sortBy";
          if(isset($request->sort_by_method)&&($request->sort_by_method)){$sortbymethod="$request->sort_by_method";}

          $student=(new StudentRepository())->studentshortlist(['search'=>$search])->$sortbymethod($request->order_by);

            $successdata=array();
            foreach ($student as $data){

                $successdata[]=[
                    'db_id'=>$data->id,
                    'student_id'=>$data->student_id,
                    'sr_no'=>$data->form_no,
                    'admission_date'=>$data->student->admission_date,
                    'admission_no'=>$data->admission_no,
                    'roll_no'=>$data->roll_no,
                    'student_name'=>$data->fullName(),
                    'gender'=>$data->student->gender ? $data->student->gender : "male",
                    'course_id'=>$data->course_id,
                    'section_id'=>$data->section_id,
                    'course'=>$data->CourseSection(),
                    'dob'=>$data->student->dob,
                    'category_id'=>$data->category_id,
                    'aadhar_no'=>$data->student->aadhar_card_no,
                    'father_name'=>$data->FatherName(),
                    'contact_no'=>$data->student->contact_no,
                    'alt_contact_no'=>$data->student->mother_mobile_no,
                    'mother_name'=>$data->student->mother_name,
                    'residence_address'=>$data->student->residence_address,
                    'transport_id'=>$data->transport_id,
                    'profile_img'=>$data->ProfileImage(),
                ];

            }

        }catch (\Exception $e){}

        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$successdata
        ],200);

    }
}
