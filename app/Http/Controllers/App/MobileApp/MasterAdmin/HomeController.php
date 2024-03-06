<?php

namespace App\Http\Controllers\MobileApp\MasterAdmin;

use App\Helper\CommunicationBalance;
use App\Helper\MobileAppModule;
use App\Helper\UserActivityLogs;
use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
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
         * Student Count and Staff Count
         */
        $studentstrength = 0;
        $staffstrength = 0;
        $communicationbalance = 0;
        try {
            $studentstrength = studentstrength(['status'=>'active']);
            $staff = dbtablesum(\App\Models\MasterAdmin\Staff\StaffRecord::class, ['dbrow' => 'count(id) as totalstrength', 'customsearch' => ['where' => ['deleted_at' => '']]]);
            $staffstrength = $staff->totalstrength;
            $communication = CommunicationBalance::Balance();
            if (isset($communication->text_balance)) {
                $communicationbalance = $communication->text_balance;
            }
        } catch (\Exception $e) {
        }

        //course list
        $courselist = array();
        try {
            $course = (new CommanDataRepository())->courseselectlist();
            foreach ($course as $data) {
                foreach ($data->sections as $data1) {
                    $courselist[] = ['keyid' => $data->id."@".$data1->id, 'value' => $data->course . "-" . $data1->section];
                }
            }
        } catch (\Exception $e) {}

        $totalcollect=0; $totalreceipt=0;  $totalexpense=0; $totalvoucher=0;
        try {
            /*
               * fianance get details
               */
            $fromdate=nowdate('','Y-m-d');
            $enddate=nowdate('','Y-m-d');

            $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
            if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
            if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}
        }catch (\Exception $e){}

        $user = auth()->user();
        return response()->json([
            'result' => 1,
            'success' => [
                [
                    'user-info' => [
                        [
                            'user_no' => $user->id,
                            'user_name' => $user->fullName(),
                            'user_info' => $user->roles->first()->name,
                            'profile_img' => url($user->ProfileImage()),
                            'last_login' => '23-Jul-2020 13:10:12 AM'
                        ]
                    ],
                    'data-info' => [
                        ['key' => "Total Student", 'value' => $studentstrength],
                        ['key' => 'Total Staff', 'value' => $staffstrength],
                        ['key' => 'today_fee_collection', 'value' => $totalcollect],
                        ['key' => 'Communication Balance', 'value' => $communicationbalance],
                        ['key' => 'today_expense', 'value' => $totalexpense]
                    ],
                    'module' => [MobileAppModule::mobileappusermodule()],
                    'course' => $courselist,
                    'website' => $user ? $user->SchoolWebsiteUrl() : null,
                    'academic_session' => $user ? $user->SessionName() : null
                ]
            ]
        ]);
    }
}
