<?php

namespace App\Http\Controllers\MasterAdmin\Staff;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Staff\StaffRecord;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{

    /*
     * Mobile Api
     */
    public function apistaffprofile($userid, $staffid)
    {
        try {

            $staff = StaffRecord::find($staffid);
            $staffresult[]=[
                'staff_id' => $staff->id,
                'joining_date' => nowdate($staff->joining_date, 'd-F-Y'),
                'staff_no' => $staff->staff_no,
                'date_of_retire' =>$staff->date_of_retire ? nowdate($staff->date_of_retire,'d-F-Y') : null,
                'date_of_extend' =>$staff->date_of_extend ? nowdate($staff->date_of_extend,'d-F-Y') : null,
                'profession_type' =>$staff->ProfessionTypeName(),
                'staff_type' => $staff->StaffTypeName(),
                'department' => $staff->DepartmentName(),
                'designation' => $staff->DesignationName(),
                'show_in_transpor' =>$staff->show_in_transpor,
                'transport' =>$staff->TransportName(),
                'hostel' =>$staff->HostelName(),
                'shift' =>$staff->ShiftName(),
                'integrate' =>$staff->integrate,
                'title' =>ucfirst($staff->title),
                'first_name' =>$staff->first_name,
                'middle_name' =>$staff->middle_name,
                'last_name' =>$staff->last_name,
                'gender' =>$staff->gender,
                'blood_group' =>$staff->blood_group,
                'dob' => $staff->dob ? nowdate($staff->dob,'d-F-Y') : null,
                'doa' => $staff->doa ? nowdate($staff->doa,'d-F-Y') : null,
                'nationality' => $staff->NationalityName(),
                'religion' => $staff->ReligionName(),
                'category' => $staff->CategoryName(),
                'aadhaar_no'=>$staff->aadhaar_no,
                'pan_no'=>$staff->pan_no,
                'license_no'=>$staff->license_no,
                'passport_no'=>$staff->passport_no,
                'contact_no'=>$staff->contact_no,
                'alt_mobile_no'=>$staff->alt_mobile_no,
                'email'=>$staff->email,
                'father_name'=>$staff->father_name,
                'mother_name'=>$staff->mother_name,
                'spouse_name'=>$staff->spouse_name,
                'residence_address'=>$staff->residence_address,
                'permanent_address'=>$staff->permanent_address,
                'account_number'=>$staff->account_number,
                'ifsc_code'=>$staff->ifsc_code,
                'bank_name'=>$staff->bank_name,
                'bank_location'=>$staff->bank_location,
                'nominee_name'=>$staff->nominee_name,
                'nominee_relation'=>$staff->nominee_relation,
                'profile'=>FileUrl($staff->profile_img),
                'class_teacher'=>null,
                'attendance'=>null
            ];

            return response()->json([
                'result'=>1,
                'message'=>'data found',
                'success'=>$staffresult
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'result' => 2,
                'message' => 'technical problem',
                'success' => null
            ], 400);
        }
    }
}
