<?php


namespace App\Repositories\MasterAdmin\Attendance;


use App\Models\MasterAdmin\Attendance\Holiday;
use App\Models\MasterAdmin\Attendance\LeaveRecord;
use App\Models\MasterAdmin\Attendance\LeaveType;
use App\Models\MasterAdmin\Attendance\StudentAttendance;
use App\Repositories\MasterAdmin\RepositoryContract;

class StudentAttendanceRepositories extends RepositoryContract
{
    public function stduentattendancelist($search=null,$relation=null)
    {
        return StudentAttendance::query()->search($search)->record()->get();
    }

    public function leaverecordlist($search=null,$relation=null)
    {
        return LeaveRecord::query()->search($search)->record()->get();
    }

    public function leaverecordlistdesc($search=null,$relation=null)
    {
        return LeaveRecord::query()->search($search)->record()->orderBy('created_at','desc')->get();
    }

    public function leavetypelist($search=null,$relation=null)
    {
        return LeaveType::query()->search($search)->record()->get();
    }

    public function holidaylist($search=null,$relation=null)
    {
        return Holiday::query()->search($search)->record()->get();
    }
}
