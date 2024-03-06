<?php

namespace App\Http\Controllers\MasterAdmin\Admission;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /*
     * Mobile Api
     */
    public function apistudentprofile($userid, $studentid)
    {
        try {
            $studentdata = (new StudentRepository())->studentshortlist(['student_id'=>$studentid])->map(function ($student){
                return [
                    'db_id' =>$student->id,
                    'student_id' =>$student->admission_no,
                    'admission_no'=>$student->admission_no,
                    'admission_date' =>$student->student->admission_date ? nowdate($student->student->admission_date,'d-F-Y') : null,
                    'course'=>$student->CourseSection(),
                    'full_name' =>$student->fullName(),
                    'gender' => ucwords($student->student->gender),
                    'dob' => $student->student->dob ? nowdate($student->student->dob, 'd-F-Y') : null,
                    'blood_group' =>$student->student->blood_group,
                    'nationality' =>$student->NationalityName(),
                    'religion' =>$student->ReligionName(),
                    'category' =>$student->CategoryName(),
                    'caste' =>$student->CasteName(),
                    'aadhar_card_no' =>$student->student->aadhar_card_no,
                    'birth_certificate_no' =>$student->student->birth_certificate_no,
                    'contact_no' =>$student->student->contact_no,
                    'email' =>$student->student->email,
                    'father_name' =>$student->FatherName(),
                    'father_mobile_no' =>$student->student->father_mobile_no,
                    'mother_name' =>$student->MotherName(),
                    'mother_mobile_no' =>$student->student->mother_mobile_no,
                    'local_guardian_relation' =>$student->student->local_guardian_relation,
                    'local_guardian_name' =>$student->student->local_guardian_name,
                    'residence_address'=>$student->student->residence_address,
                    'permanent_address'=>$student->student->permanent_address,
                    'profile'=>$student->ProfileImage()
                ];
            });


            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success'=>$studentdata
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 0,
                'message' => 'technical problem'
            ], 200);
        }
    }
}
