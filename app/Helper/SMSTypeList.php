<?php


namespace App\Helper;


class SMSTypeList
{
    public static function getlist()
    {
        return [
          'student-admission'=>'Student Admission',
          'prospectus-entry'=>'Prospectus Entry',
          'student-attendance'=> 'Student Attendance',
          'fee-submit'=>'Student Fee Collection'
        ];
    }
}
