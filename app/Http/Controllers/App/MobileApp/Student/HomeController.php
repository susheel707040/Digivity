<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Helper\MobileAppModule;
use App\Helper\UserActivityLogs;
use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Attendance\StudentAttendance;
use App\Repositories\MasterAdmin\Finance\FinanceFeeCollectionRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($userid)
    {

        /*
        * Get User Details
        */
        try {
            $user = User::find($userid);
            UserActivityLogs::log($user,'dashboard',$logs=1);
        } catch (\Exception $e) {
            $user = null;
        }
        /*
         * Get Student Fees Record
         */
        $currentdate = nowdate('', 'Y-m-d');
        $feepayable = 0;
        $latefee = 0;
        try {
            /*
             * Student Profile Details
             */
            $student = (new StudentRepository())->studentshortlist(['student_id' => $user->student_id])->first();
            /*
             * Student Fee Details
             */
            $studentfee = (new FinanceFeeCollectionRepository())->studentfeerecord(studentparameter($student), $currentdate, 0);
            $feepayable = $studentfee[5]['feepayable'];
            $latefee = $studentfee[3]['finetotal'];
        } catch (\Exception $e) {}

        if (isset($student) && ($student)) {
            /*
             * Student Total Attendance
             */
            $attendancepercantage = 0;
            try {
                $attendancerecord = $this->studentattendancecalculation(['student_id' => $user->student_id]);
                $totalattendance = $attendancerecord ? $attendancerecord->totalattendance : 0;
                $totalpresent = $attendancerecord ? $attendancerecord->totalpresent : 0;
                if (is_numeric($totalpresent)) {
                    $attendancepercantage = ($totalpresent * 100 / $totalattendance);
                }
            } catch (\Exception $e) {
            }
            return response()->json([
                'result' => 1,
                'message' => 'record found',
                'status'=>'active',
                'success' => [
                    [
                        'student-info' => [
                            [
                                'admission_no' => $student ? $student->admission_no : 0,
                                'student_name' => $student ? $student->FullName() : "N/A",
                                'course' => $student ? $student->CourseSection() : "N/A",
                                'session' => $student ? $student->SessionName() : "N/A",
                                'father' => $student ? $student->FatherName() : "N/A",
                                'profile_img' => $student ? $student->ProfileImage() : null
                            ]
                        ],
                        'data-info' => [
                            ['key' => "School Fee", 'value' => numberformat($feepayable)],
                            ['key' => 'Late Fee', 'value' => numberformat($latefee)],
                            ['key' => 'Total Att.', 'value' => '' . numberformat($attendancepercantage,2) . '%'],
                            ['key' => 'Today Att.', 'value' => strtoupper($student->AttendanceStatus($currentdate))]
                        ],
                        'module' => [MobileAppModule::mobileappusermodule()],
                        'website' => $user ? $user->SchoolWebsiteUrl() : null,
                        'academic_session' => $user ? $user->SessionName() : null,
                        'last_login_at'=>$user ? $user->LastLoginAt() : null
                    ]
                ]
            ], 200, [], JSON_NUMERIC_CHECK);
        }

        return response()->json([
            'result' => 1,
            'message' => 'record found',
            'status'=>'inactive',
            'success' =>null
            ],200);
    }

        /*
         * Student Attendance Calculation
         */

        function studentattendancecalculation($search = null, $customsearch = null)
        {
            $attendancerecord = dbtablesum(StudentAttendance::class,
                ['dbrow' => 'SUM(if(attendance="p",1,0)) as totalpresent,SUM(if(attendance="a",1,0)) as totalabsent,SUM(if(attendance="lv",1,0)) as totalleave,SUM(if(attendance="lt",1,0)) as totallate,count(id) as totalattendance'
                    , 'search' => $search, 'customsearch' => $customsearch]);
            return $attendancerecord;
        }

}
