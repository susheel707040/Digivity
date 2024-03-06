<?php

namespace App\Http\Controllers\App\MobileApp\Staff;

use App\Helper\SendMessage;
use App\Helper\SMSTemplate;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Attendance\StudentAttendance;
use App\Notifications\MasterAdmin\StudentAttendanceNotification;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;


class StudentAttendanceController extends Controller
{
    public function index($userid, $courseid, $sortby, $attendancedate, Request $request)
    {
        $successdata = array();
        try {
            //date format convert
            $attendancedate = nowdate($attendancedate, 'Y-m-d');
            //search array create for student search
            $search = array();
            if ($courseid) {
                $course = explode("@", $courseid);
                $course_id = $course[0];
                $section_id = $course[1];
                $search = array_merge($search, ['course_id' => $course_id, 'section_id' => $section_id]);
            }
            $student = (new StudentRepository())->studentshortlist(['search' => $search])->sortBy('roll_no');
            foreach ($student as $data) {
                $successdata[] = [
                    'student_id' => $data->student_id,
                    'admission_no' => $data->admission_no,
                    'roll_no' => $data->roll_no,
                    'student_name' => $data->fullName(),
                    'course' => $data->CourseSection(),
                    'gender'=> $data->student->gender ? $data->student->gender : "male",
                    'father_name' => $data->FatherName()." (".$data->student->contact_no.")",
                    'profile_img' => $data->ProfileImage(),
                    'attendance' => $data->AttendanceStatus($attendancedate),
                    'holiday' => 'no'
                ];
            }

        }catch (\Exception $e){
        }
        if($successdata){
            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => $successdata
            ],200);
        }
    }

    /*
     * Student Attendance Data Store
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (isset($data['attendancesubmitted_classSec'])) {
            /*
             * Course and Section get
             */
            $course = explode("@", $data['attendancesubmitted_classSec']);
            $course_id = $course[0];
            $section_id = $course[1];

            /*
             * Student data post with attendance startus
             */
            if (isset($data['data'])) {
                /*
                 * attendance submit
                 */
                $studentids = array();
                $attendancecheck = StudentAttendance::query()->where(['course_id' => $course_id, 'section_id' => $section_id, 'attendance_date' => nowdate($request->att_date,'Y-m-d')])->count();
                if (!$attendancecheck) {
                    foreach ($data['data'] as $attendancedata) {
                        $datainsert = [
                            'course_id' => $course_id,
                            'section_id' => $section_id,
                            'student_id' => $attendancedata['student_id'],
                            'attendance_date' => nowdate($attendancedata['att_date'],'Y-m-d'),
                            'attendance' => strtolower($attendancedata['current_status'])
                        ];
                        $studentattendance = StudentAttendance::create($datainsert);
                        /*
                         * After Submit Page Notify Parents Attendance SMS/Email
                         */
                        if (strtolower($studentattendance->attendance) == "a") {
                            $studentids=array_merge($studentids,[$studentattendance->student_id]);
                        }
                    }
                    /*
                     * Attendance Submitted SMS
                     */
                    if(is_array($studentids)&&(count($studentids)>0)){
                        $message=SMSTemplate::getsmsbyid('student-attendance');
                        $message ? $sendsms=SendMessage::pushsms(['studentid'=>$studentids,'message'=>$message->template,'unicode'=>$message->unicode]) : "";
                    }

                    return response()->json([
                        'result' => 1,
                        'message' => 'Attendance Submit Successful Complete'
                    ], 200);
                }
                return response()->json([
                    'result' => 1,
                    'message' => 'Attendance Already Submit Successful Complete'
                ], 200);
            }
        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Some Data Missing'
        ], 400);


    }


}
