<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Attendance\StaffAttendanceRequest;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Models\MasterAdmin\Attendance\StaffAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        if(isset($request)&&$request) {
        $staff=(new StaffRepositories())->staffshortlist([$request->all()]);

        }

       return view('app.erpmodule.MasterAdmin.Attendance.Entry.staff-mark-attendance',compact(['staff']));
    }
    public function store($designationid,$departmentid,$attendancedate,StaffAttendanceRequest $request){
        $request->validated();
        $attendancedate=Carbon::createFromDate($attendancedate)->format('Y-d-m');
        StaffAttendance::query()->where(['designation_id'=>$designationid,'department_id'=>$departmentid,'attendance_date'=>$attendancedate])->forceDelete();
        if ($request->has('staffid') && !empty($request->staffid)) {
        foreach ($request->staffid as $staffid){
            $data=[
                'designation_id'=>$designationid,
                  'department_id'=>$departmentid,
                  'staff_id'=>$staffid,
                  'attendance_date'=>$attendancedate,
                  'attendance' => $request->input("att_type_{$staffid}_id"),
                  'punch_in' => $request->input("punch_in_{$staffid}"),
                  'punch_out' => $request->input("punch_out_{$staffid}")
              ];
              StaffAttendance::create($data);
    }
    return back()->with('success','Staff Attendance Save Successfully');
}

else {
    return back()->with('error', 'No staffid provided');
}
}
}
