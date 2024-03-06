<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Attendance\HolidayRequest;
use App\Models\MasterAdmin\Attendance\Holiday;
use App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        $holidaylist=(new StudentAttendanceRepositories())->holidaylist($request->all());
        return view('app.erpmodule.MasterAdmin.Attendance.MasterSetting.define-holiday',compact(['holidaylist']));
    }

    public function store(HolidayRequest $request)
    {
        try {
            $data=$request->validated();
            $data['holiday_from_date']=nowdate($request->holiday_from_date,'Y-m-d');
            $data['holiday_to_date']=nowdate($request->holiday_to_date,'Y-m-d');
            session(['keyid' => 'addModels','url'=>'0']);
            $holiday=Holiday::create($data);
            return back()->with('success', 'Record Save Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(Holiday $holiday)
    {
        return view('app.erpmodule.MasterAdmin.Attendance.MasterSetting.Add.add-holiday',compact(['holiday']));
    }

    public function modify(Holiday $holiday,HolidayRequest $request)
    {
        try {
            $data=$request->validated();
            $data['holiday_from_date']=nowdate($request->holiday_from_date,'Y-m-d');
            $data['holiday_to_date']=nowdate($request->holiday_to_date,'Y-m-d');
            session(['keyid' => 'editModels','url'=>'/MasterAdmin/Attendance/EditViewHoliday/'.$holiday->id.'/edit']);
            $holiday->update($data);
            return back()->with('success', 'Record Save Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
