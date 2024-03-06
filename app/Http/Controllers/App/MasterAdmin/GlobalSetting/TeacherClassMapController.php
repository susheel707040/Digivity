<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\GlobalSetting\StaffMapCourse;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class TeacherClassMapController extends Controller
{
    public function index(Request $request)
    {
        $course = coursesectionlist();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.class-teacher-map', compact(['course']));
    }

    public function indexsearch($staffno, $staffid)
    {
        $staff = (new StaffRepositories())->staffshortlist(['search' => ['staff_no' => $staffno, 'id' => $staffid]])->first();
        $teacherwithcourse=StaffMapCourse::query()->where(['staff_id'=>$staff->id])->record()->get();

        $course = (new CommanDataRepository())->courseselectlist();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.class-teacher-map', compact(['course', 'staff','teacherwithcourse']));
    }

    /*
     * Class Map Teacher store
     */
    public function store(Request $request)
    {
        try {
            $course=explode("@",$request->for_class_id);
            $for_courseid=$course[0];
            $for_sectionid=$course[1];

            /*
             * Delete Staff
             */
            StaffMapCourse::query()->where(['staff_id'=>$request->staff_id])->record()->forceDelete();
            if(isset($request->class_id)) {
                foreach ($request->class_id as $value) {

                    $couserarr=explode("@",$value);
                    $courseid=$couserarr[0];
                    $sectionid=$couserarr[1];

                    $data = [
                        'staff_id' => $request->staff_id,
                        'course_id' => $courseid,
                        'section_id' => $sectionid,
                        'for_course_id'=> $for_courseid,
                        'for_section_id'=> $for_sectionid
                    ];
                    $staffwithcourse = StaffMapCourse::create($data);
                }

                if ($staffwithcourse) {
                    return back()->with('success', 'Teacher Course Map Successful Complete');
                }
            }else{
                return back()->with('danger', 'Please choose atleast one class/course');
            }

        }catch (\Exception $e){}
        return back()->with('danger', 'Sorry, Request Failed, Please Try Again');
    }

    /*
     * Teacher Map Class/Course Remove
     */
    public function remove($staffid)
    {
        try {
            StaffMapCourse::query()->where(['staff_id'=>$staffid])->record()->forceDelete();
            return back()->with('success', 'Teacher Course Map Remove Successful Complete');
        }catch (\Exception $e){}
        return back()->with('danger', 'Sorry, Request Failed, Please Try Again');
    }


}
