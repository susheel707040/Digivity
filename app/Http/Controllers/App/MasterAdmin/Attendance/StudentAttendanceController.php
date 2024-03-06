<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Attendance\StudentAttendanceRequest;
use App\Models\MasterAdmin\Attendance\StudentAttendance;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $student=[];
        if(isset($request)&&$request) {
            $student = (new StudentRepository())->studentshortlist($request->all());
            // dd($student);
        }
        return view('app.erpmodule.MasterAdmin.Attendance.Entry.student-mark-attendance',compact(['student']));
    }

    public function bulkindex($courseid,$sectionid,$attendancedate)
    {
        return view('app.erpmodule.MasterAdmin.Attendance.Entry.student-bulk-mark-attendance');
    }

    public function store($courseid,$sectionid,$attendancedate,StudentAttendanceRequest $request)
    {
        $request->validated();
        $attendancedate=Carbon::createFromDate($attendancedate)->format('Y-d-m');
        StudentAttendance::query()->where(['course_id'=>$courseid,'section_id'=>$sectionid,'attendance_date'=>$attendancedate])->forceDelete();
        foreach ($request['studentid'] as $studentid){
            $data=[
              'course_id'=>$courseid,
                'section_id'=>$sectionid,
                'student_id'=>$studentid,
                'attendance_date'=>$attendancedate,
                'attendance'=>$request["att_type_".$studentid."_id"]
            ];
            StudentAttendance::create($data);

        }
        return back()->with('success','Student Attendance Save Successful Complete');
    }

    /*
     * Mobile Application Api Controller
     */

}
