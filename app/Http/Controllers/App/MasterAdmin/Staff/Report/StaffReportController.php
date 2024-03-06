<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffReportController extends Controller
{
    public function index()
    {
        $staff=(new StaffRepositories())->staffshortlist([]);
        return view('app.erpmodule.MasterAdmin.Staff.Reports.staff-list',compact(['staff']));
    }

    public function staffcredentials()
    {
        $staff=(new StaffRepositories())->staffshortlist([]);
        return view('app.erpmodule.MasterAdmin.Staff.Reports.staff-credentials-report',compact(['staff']));
    }

    /*
     * Mobile Application Controller
     */

    public function apistafflist(Request $request)
    {
        // DB::table('testapi')->insert(['data'=>serialize($request->all())]);
        try {
            //sory by method
            $sortbymethod="sortBy";
            if(isset($request->sort_by_method)&&($request->sort_by_method)){$sortbymethod="$request->sort_by_method";}

            $staffdata=[];
            $staff=(new StaffRepositories())->staffshortlist($request->all())->$sortbymethod($request->order_by);
            foreach ($staff as $data){
                $staffdata[]=[
                    'db_id'=>$data->id,
                    'joining_date'=>nowdate($data->joining_date,'d M Y'),
                    'staff_no'=>$data->staff_no,
                    'profession'=>$data->ProfessionTypeName(),
                    'staff_type'=>$data->StaffTypeName(),
                    'department'=>$data->DepartmentName(),
                    'designation'=>$data->DesignationName(),
                    'first_name'=>$data->first_name,
                    'full_name'=>$data->fullName(),
                    'father_name'=>$data->FatherName(),
                    'spouse_name'=>$data->SpouseName(),
                    'contact_no'=>$data->contact_no,
                    'email'=>$data->email,
                    'address'=>$data->Address(),
                    'profile_img'=>$data->ProfileImage(),
                    'retire_date'=>nowdate($data->date_of_retire,'d M Y'),
                    'profession_type_id'=>$data->profession_type_id,
                    'staff_type_id'=>$data->staff_type_id,
                    'department_id'=>$data->department_id,
                    'designation_id'=>$data->designation_id,
                    'title'=>$data->title,
                    'gender'=>$data->gender,
                    'dob'=>nowdate($data->dob,'d M Y'),
                    'aadhar_no'=>$data->aadhaar_no,
                    'pan_no'=>$data->pan_no,
                    'marital_status'=>$data->marital_status,
                    'account_no'=>$data->account_number,
                    'ifsc_code'=>$data->ifsc_code,
                    'bank_name'=>$data->bank_name
                ];
            }

            return response()->json([
                'result'=>1,
                'message'=>'data found',
                'success'=>$staffdata
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'result'=>2,
                'message'=>'Sorry, technical problem, please try again.',
                'success'=>null
            ],200);
        }
    }
}
