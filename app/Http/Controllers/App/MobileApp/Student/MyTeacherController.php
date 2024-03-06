<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class MyTeacherController extends Controller
{
    public function report($studentid)
    {
        $staffdata = [];
        $student=(new StudentRepository())->studentshortlist(['student_id'=>$studentid])->first();
        if(isset($student)&&($student)) {
            $teacherids=(new CommanDataRepository())->classteacherids(['course_id'=>$student->course_id,'section_id'=>$student->section_id]);
            try {
                if(isset($teacherids)&&(is_array($teacherids))&&(count($teacherids)>0)) {
                    $staff = (new StaffRepositories())->staffshortlist(['customsearch' => ['whereIn' => ['id' => $teacherids]]]);
                    $staffdata = collect($staff)->map(function ($data) {
                        return [
                            'staff_id' => $data->id,
                            'staff_name' => $data->fullName(),
                            'subject' => null,
                            'staff_info' => null,
                            'staff_profile' => $data->ProfileImage()
                        ];
                    })->toArray();
                }
            } catch (\Exception $e) {
            }
        }
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$staffdata
        ]);
    }
}
