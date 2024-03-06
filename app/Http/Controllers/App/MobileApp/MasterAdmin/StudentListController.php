<?php

namespace App\Http\Controllers\MobileApp\MasterAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function index($userid,$courseid)
    {
        $search=array();
        if($courseid){
            $course=explode("@",$courseid);
            $course_id=$courseid[0];
            $section_id=$courseid[1];
            $search[]=['course_id'=>$course_id,'section_id'=>$section_id];
        }

        $student=(new StudentRepository())->studentshortlist(['search'=>$search]);
        $successdata=array();
        foreach ($student as $data){
            $successdata[]=[
                'student_id'=>$data->student_id,
                'admission_no'=>$data->admission_no,
                'roll_no'=>$data->roll_no,
                'student_name'=>$data->fullName(),
                'course'=>$data->CourseSection(),
                'father_name'=>$data->student->father_name,
                'contact_no'=>$data->student->contact_no,
                'profile_img'=>asset($data->profile_img),
                'attendance'=>'p'
            ];
        }
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$successdata
        ],200);
    }
}
