<?php

namespace App\Http\Controllers\MobileApp\Staff;

use App\Helper\MobileAppModule;
use App\Helper\UserActivityLogs;
use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Staff\StaffRecord;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Models\User;
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
         * Get Staff/Employee Details
         */
        try {
            $staff = (new StaffRepositories())->staffshortlist(['ac_user_id' => $userid])->shift();
        } catch (\Exception $e) {
            $staff = null;
        }


        //course list
        $courselist = array();
        try {
            $course = (new CommanDataRepository())->teachercoursewithsection(['staff_id'=>$staff->id]);
            foreach ($course as $data) {
                    $courselist[] = ['keyid' => $data->course_id . "@" . $data->section_id, 'value' => $data->CourseName() . "-" . $data->SectionName()];
            }
        } catch (\Exception $e) {
        }


        return response()->json([
            'result' => 1,
            'message' => 'record found',
            'success' => [[
                'user-info' => [
                    [
                        "user_no" => $staff ? $staff->staff_no : null,
                        'user_name' => $staff ? $staff->fullName() : null,
                        'user-info' => $staff ? $staff->DepartmentName() . " - " . $staff->DesignationName() : null,
                        'profile_img' => $staff ? $staff->ProfileImage() : null,
                        'last_login' => '10-Feb-2020 11:00:12 AM'
                    ]
                ],
                'data-info' => [
                    ['key' => "Salary", 'value' => 'Rs. 0.00'],
                    ['key' => 'Deduction', 'value' => 'Rs. 0.0'],
                    ['key' => 'Total Att.', 'value' => '0%'],
                    ['key' => 'Today Att.', 'value' => 'N/A']
                ],
                'module' => [MobileAppModule::mobileappusermodule()],
                'course' => $courselist,
                'website' => $user ? $user->SchoolWebsiteUrl() : null,
                'academic_session' => $user ? $user->SessionName() : null,
                'last_login_at'=>$user ? $user->LastLoginAt() : null
            ]]
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
