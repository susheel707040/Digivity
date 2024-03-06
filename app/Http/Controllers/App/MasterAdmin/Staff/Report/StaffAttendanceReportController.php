<?php

namespace App\Http\Controllers\MasterAdmin\Staff\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffAttendanceReportController extends Controller
{
    /*
     * Mobile Api Attendance Report
     */
    public function apiattendancereport($userid,$staffid,$month)
    {
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            /*'success'=>[[
              'attendance'=>[
                  ['total_attendance'=>26,'total_present'=>12,'total_absent'=>10,'total_leave'=>3]
              ],
              'monthly_attendance'=>[
                ['date'=>'01-May-2020','check_in'=>'09:10:00 AM','check_out'=>'02:00:00 PM','late'=>'10 Minutes','status'=>'Present'],
                ['date'=>'02-May-2020','check_in'=>'09:20:00 AM','check_out'=>'02:00:00 PM','late'=>'20 Minutes','status'=>'Present'],
                ['date'=>'03-May-2020','check_in'=>'---','check_out'=>'---','late'=>'---','status'=>'Holiday']
              ],
            ]]*/
            'success'=>[
                [
                    'attendance'=>[],
                    'monthly_attendance'=>[]
                ]

            ]
        ],200);
    }
}
