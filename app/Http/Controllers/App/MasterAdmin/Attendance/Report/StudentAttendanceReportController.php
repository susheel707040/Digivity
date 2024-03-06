<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance\Report;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Attendance\StudentAttendance;
use App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class StudentAttendanceReportController extends Controller
{
    public function daywiseattendanceindex(Request $request)
    {
       $student=(new StudentRepository())->studentshortlist($request->all());
       return view('app.erpmodule.MasterAdmin.Attendance.Reports.Student.day-wise-student-attendance-report',compact(['student']));
    }

    public function classwisemisreport(Request $request)
    {
        $course=(new CommanDataRepository())->courseselectlist();
        return view('app.erpmodule.MasterAdmin.Attendance.Reports.Student.class-wise-mis-report',compact(['course']));
    }

    public function studentmonthlymisreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.Attendance.Reports.Student.student-monthly-attendance-mis-report',compact(['student']));
    }

    public function studentattendancemisreport(Request $request)
    {
        
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.Attendance.Reports.Student.student-attendance-mis-report',compact(['student']));
    }


    public function apistudentabsentdate($studentid)
    {
        try {
            /*
            * Student Profile Details
            */
            $student = (new StudentRepository())->studentshortlist(['student_id' => $studentid])->first();
            $user = User::find($student->ac_user_id);
        } catch (\Exception $e) {}

        if (isset($student)) {
            /*
             * Day wise Absent list
             */
            $absentdayslist = array();
            try {
                /*
                 * Create search query custom
                 */
                $search = ['search' => ['student_id' => $studentid, 'attendance' => 'a']];
                /*
                 * Student Attendance Reports list
                 */
                $stduentattendance = (new StudentAttendanceRepositories())->stduentattendancelist($search)->sortBy('attendance_date');
                foreach ($stduentattendance as $data) {
                    $absentdayslist[] = ['day' => nowdate($data->attendance_date, 'd F Y')];
                }
            } catch (\Exception $e) {
            }

            /*
             * Student Attendance Chart Data
             */
            $attendancerecord = [];
            try {
                $attendancerecord = $this->studentattendancecalculation(['student_id' => $studentid]);
            } catch (\Exception $e) {
            }

            /*
             * Month Wise Student Attendance Summary
             */
            $monthattendancelist = array();
            if ($user) {
                $startdate = $user->academicyear ? $user->academicyear->start_date : nowdate('', 'Y-m-d');
                $enddate = $user->academicyear ? $user->academicyear->end_date : nowdate('', 'Y-m-d');
                foreach (CarbonPeriod::create($startdate, '1 month', $enddate) as $month) {
                    $months[$month->format('Y-m')] = $month->format('F Y');
                }
                foreach ($months as $startdate => $string_month_name) {
                    $attendancerecordyear = $this->studentattendancecalculation(['student_id' => $studentid], ['whereBetween' => ['attendance_date' => [$startdate . '-1', $startdate . '-31']]]);

                    $totalattendance=$attendancerecordyear ? $attendancerecordyear->totalattendance : 0;
                    $totalpresent=$attendancerecordyear ? $attendancerecordyear->totalpresent : 0;
                    if($totalattendance>0) {
                        if(is_numeric($totalpresent)){
                            $totalpercantage=($totalpresent*100/$totalattendance);
                        }
                        $monthattendancelist[] = ['month' => $string_month_name, 'present' => '' . $totalpresent . '/' . $totalattendance . '', 'percentage' => ''.$totalpercantage.'%'];
                    }
                }
            }

            return response()->json([
                'result' => 1,
                'message' => 'attendance record found',
                'success' => [
                    [
                        'chart_data' => [
                            [
                                'present' => $attendancerecord->totalpresent ? $attendancerecord->totalpresent : 0,
                                'absent' => $attendancerecord->totalabsent ? $attendancerecord->totalabsent : 0,
                                'leave' => $attendancerecord->totalleave ? $attendancerecord->totalleave : 0,
                                'late' => $attendancerecord->totallate ? $attendancerecord->totallate : 0,
                            ]
                        ],
                        'absent_attendance_report' => $absentdayslist,
                        'month_attendance_report' => $monthattendancelist
                    ]
                ]
            ], 200);
        }

        return response()->json([
            'result' => 0,
            'message' => 'sorry,record no found',
            'success' => null
        ], 400);
    }

    /*
     * Student Attendance Calculation
     */
    public function studentattendancecalculation($search = null, $customsearch = null)
    {
        $attendancerecord = dbtablesum(StudentAttendance::class,
            ['dbrow' => 'SUM(if(attendance="p",1,0)) as totalpresent,SUM(if(attendance="a",1,0)) as totalabsent,SUM(if(attendance="lv",1,0)) as totalleave,SUM(if(attendance="lt",1,0)) as totallate,count(id) as totalattendance'
                , 'search' => $search, 'customsearch' => $customsearch]);
        return $attendancerecord;
    }
}
