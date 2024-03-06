<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Attendance\LeaveTypeRequest;
use App\Models\MasterAdmin\Attendance\LeaveType;
use App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leavetypelist=(new StudentAttendanceRepositories())->leavetypelist();
        return view('app.erpmodule.MasterAdmin.Attendance.MasterSetting.define-leave-type',compact(['leavetypelist']));
    }

    public function store(LeaveTypeRequest $request)
    {
        try {
            $leavetype=LeaveType::create($request->validated());
            session(['keyid' => 'addModels','url'=>'0']);
            return back()->with('success', 'Record Save Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function edit($leavetype)
    {
        $leavetype=LeaveType::find($leavetype);
        return view('app.erpmodule.MasterAdmin.Attendance.MasterSetting.Add.add-leave-type',compact(['leavetype']));
    }

    public function update(LeaveType $leavetype,LeaveTypeRequest $request)
    {
        try {
            $leavetype->update($request->validated());
            session(['keyid' => 'editModels','url'=>route('leavetype.edit',['leavetype'=>$leavetype->id])]);
            return back()->with('success', 'Record Update Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }


    }


}
