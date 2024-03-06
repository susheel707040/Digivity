<?php

namespace App\Models\MasterAdmin\Attendance;

use App\Models\Record;
use App\Models\User;

class LeaveRecord extends Record
{
    protected $table = "attendance_leave_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'leave_to',
        'student_id',
        'staff_id',
        'total_leave',
        'leave_type_id',
        'reason',
        'start_date',
        'end_date',
        'leave_status',
        'leave_status_reason',
        'approve_by_user_id',
        'leave_status_updated',
        'document_ids',
        'user_id'
    ];

    public function leavetype()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id','id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }

    /*
     * Relation Table
     */
    public function LeaveTypeName()
    {
        try {
            return $this->leavetype->leave_type;
        }catch (\Exception $e){
            return null;
        }
    }
}
