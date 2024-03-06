<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class MyClassmateController extends Controller
{
    public function report($studentid)
    {
        //get current student details
        $student = StudentRecord::query()->where('student_id', $studentid)->record()->first();

        //classmate data get
        $classmate = [];
        $studentdata = StudentRecord::query()->where(['course_id' => $student->course_id, 'section_id' => $student->section_id])
            ->whereNotIn('student_id', [$studentid])->with(['course', 'section', 'student'])
            ->record()->get();
        if ($studentdata) {
            foreach ($studentdata as $data) {
                $classmate[] = [
                    'student_id' => $data->student_id,
                    'admission_no'=>$data->admission_no,
                    'student_name' => $data->fullName(),
                    'course' => $data->CourseSection(),
                    'dob' => nowdate($data->student->dob, 'd-M-Y'),
                    'student_profile' => $data->ProfileImage()
                ];
            }
            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => $classmate
            ], 200);
        } else {
            return response()->json([
                'result' => 0,
                'message' => 'no data found',
                'success' => null
            ], 400);
        }
    }
}
