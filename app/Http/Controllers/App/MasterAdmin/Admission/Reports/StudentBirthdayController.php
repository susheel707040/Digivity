<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentBirthdayController extends Controller
{
    public function index(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist(['customsearch'=>['whereMonth'=>['dob'=>nowdate($request->birth_day_date,'m')],'whereDay'=>['dob'=>nowdate($request->birth_day_date,'d')]]]);
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.student-birthday-report',compact(['student']));
    }

    public function apistudentbirthdayreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist(['customsearch'=>['whereMonth'=>['dob'=>nowdate($request->birth_day_date,'m')],'whereDay'=>['dob'=>nowdate($request->birth_day_date,'d')]]]);

        $student=$student->map(function ($data) use($request) {

            $birthdayyear="";
            try {
                $birthdayyear=\Carbon\Carbon::parse($data->student->dob)->diff(nowdate($request->birth_day_date,'Y-m-d'))->format('%y');
                $birthdayyear=addOrdinalNumberSuffix($birthdayyear);
            }catch (\Exception $e){}

            return [
              'id'=>$data->id,
                'student_id'=>$data->student_id,
                'admission_no'=>$data->admission_no,
                'course'=>$data->CourseSection(),
                'student_name'=>$data->fullName(),
                'gender'=>$data->student->gender,
                'father_name'=>$data->FatherName(),
                'contact_no'=>$data->student->contact_no,
                'dob'=>$data->dob() ? nowdate($data->dob(),'d-M-Y') : '',
                'birthday_no'=>$birthdayyear." Birthday",
                'profile_image'=>$data->ProfileImage()
            ];
        })->toArray();
        return response()->json([
           'result'=>1,
           'message'=>'data found!',
           'success'=>$student
        ]);
    }
}

function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
        switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
        }
    }
    return $num.'th';
}
