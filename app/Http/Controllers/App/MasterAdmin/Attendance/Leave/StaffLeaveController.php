<?php

namespace App\Http\Controllers\MasterAdmin\Attendance\Leave;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories;
use Illuminate\Http\Request;

class StaffLeaveController extends Controller
{
    /*
     * Mobile Application Staff My Leave
     */

    public function apimyleave()
    {
        return response()->json([
            'result' => 1,
            'message' => 'Data Found!',
            'success' => [
                /*[
                    'lv_id'=>1,
                    'apply_date'=>"20-04-2020",
                    'lv_from_date'=>"20-04-2020",
                    'lv_tp_date'=>"20-04-2020",
                    'lv_title'=>'My Leave App',
                    'lv_description'=>'demo test',
                    'attachment'=>[[
                        'file_id'=>1,
                        'file_name'=>'latter.png',
                        'extension'=>'.png',
                        'file_path'=>'https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-600w-1029171697.jpg'
                    ]],
                    'response_return'=>[['id'=>1,
                        'comment'=>'reject',
                        'status'=>1,
                        'approved_by'=>'amit kumar',
                        'approved_by_profile'=>null]]
                ]*/

            ]
        ], 200);
    }

    /*
     * Store Staff Leave
     */
    public function apistoreleave($userid, $staffid, Request $request)
    {
        return response()->json([
            'result' => 1,
            'message' => 'Your request submitted successful complete',
            'success' => null
        ], 200);
    }

    /*
     * Leave Type
     */
    public function apileavetype($userid)
    {
        $leavetype = (new StudentAttendanceRepositories())->leavetypelist()->map(function ($data) {
            return [
                'id' => $data->id,
                'leave_type' => $data->leave_type,
                'is_default' => 'no'
            ];
        })->toArray();
        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => $leavetype
        ], 200);
    }

}
