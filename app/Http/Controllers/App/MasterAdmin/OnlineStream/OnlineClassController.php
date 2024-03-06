<?php

namespace App\Http\Controllers\MasterAdmin\OnlineStream;

use App\Helper\GenerateTokenId;
use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\OnlineStream\OnlineClassRecord;
use App\Repositories\MasterAdmin\OnlineStream\OnlineStreamRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OnlineClassController extends Controller
{
    public function index()
    {

    }

    public function apistore(Request $request)
    {
        $joingroupid = GenerateTokenId::TokemId(6).$request->user_id;
        /*
         * Course and Section
         */
        $course = explode("@", $request->course_id);
        $course_id = $course[0];
        $seaction_id = $course[1];
        $data = [
            'join_group_id' => $joingroupid,
            'password'=>'1234',
            'member_id' => $request->user_id,
            'online_for_id' => $request->online_for_id,
            'course_id' => $course_id,
            'section_id' => $seaction_id,
            'online_period_id' => $request->online_period_id,
        ];
        $onlinerecord = OnlineClassRecord::create($data);
        return response()->json([
            'result' => $joingroupid
        ], 200);
        try {
        } catch (\Exception $e) {
            return response()->json([
                'result' => 0
            ], 400);
        }
    }

    public function apionlinedisconnect($userid,$joingroupid)
    {
        try {
            $currentdate=Carbon::now()->format('Y-m-d H:i:s');
            $onlinestream=OnlineClassRecord::query()->where(['join_group_id'=>$joingroupid,'online_status'=>1])->first();
            $startdatetime=$onlinestream->created_at;
            if($onlinestream) {
                $resultstatus = $onlinestream->update(['expire_date' => $currentdate, 'online_status' => '0']);
                if ($resultstatus) {
                    return response()->json([
                        'result' => 1,
                        'message' => 'Online Session Expire Successfully',
                        'success' => null
                    ], 200);
                }
            }
            return response()->json([
                'result' => 1,
                'message' => 'Sorry,Online Join Group Token ID Not Match',
                'success' => null
            ], 200);
        }catch (\Exception $e){

        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Request Failed, Please Try Agian',
            'success' => null
        ], 400);
    }

    public function apionlineclass()
    {

    }

    public function apistudentonlinelist($userid,$studentid)
    {
        $search=['course_id'=>0];
        try {
            /*
            * Student Profile Details
            */
            $student = (new StudentRepository())->studentshortlist(['student_id' => $studentid])->first();
            $search=['course_id'=>$student->course_id,'section_id'=>$student->section_id,'online_status'=>1];
        }catch (\Exception $e){}


        $onlineclasslist = array();
        $onlineclass = (new OnlineStreamRepositories())->onlineclasslist($search);
        foreach ($onlineclass as $data) {

            try {
                $user=User::find($data->member_id);
            }catch (\Exception $e){}

            $onlineclasslist[] = [
                'id' => $data->id,
                'join_group_id' => $data->join_group_id,
                'password' => $data->password,
                'onlinefor' => $data->OnlineForName(),
                'onlineperiod' => $data->OnlinePeriodName(),
                'online_status' => $data->online_status,
                'join' => $data->joins,
                'member_name'=> $user ? $user->fullName() : "N/A",
                'member_profile'=> $user ? $user->ProfileImage() : null,
                'submitted_by' => $user ? $user->fullName() : "N/A",
                'submitted_by_profile' => $user ? $user->ProfileImage() : null
            ];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => $onlineclasslist
        ]);
    }
}
