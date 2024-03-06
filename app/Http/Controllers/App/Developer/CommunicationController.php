<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Communication\CommunicationBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /*
     * developer communication index
     */
    public function communicationindex($schoolid, $branchid, $academicid, $tokenid)
    {
        $communicationdetail = [];
        $communication = CommunicationBalance::query()->where(['academic_id' => $academicid])->get();
        foreach ($communication as $data) {
            $communicationdetail[] = [
                'id' => $data->id,
                'month' => $data->month,
                'start_date' => $data->start_date,
                'end_date' => $data->end_date,
                'text_balance' => $data->text_balance,
                'text_use_balance' => $data->text_use_balance,
                'email_balance' => $data->email_balance,
                'email_use_balance' => $data->email_use_balance,
                'app_balance' => $data->app_balance,
                'app_use_balance' => $data->app_use_balance];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => $communicationdetail
        ]);
    }

    /*
     * developer communication balance increase and decrease
     * @param $tokenid
     * @param Request $request
     * @return array
     */
    public function store($tokenid, Request $request)
    {

        $now = Carbon::now();
        $insertcount=0;
        foreach ($request->month as $key=>$monthid){
            if($monthid) {
                try {

                    //delete month
                    CommunicationBalance::query()->where(['academic_id' => $request->academic_id,'month'=>$monthid])->forceDelete();

                    $data= [
                        'school_id' => $request->school_id,
                        'branches_id' => $request->branch_id,
                        'academic_id' => $request->academic_id,
                        'month' => $monthid,
                        'start_date' => nowdate($request->start_date[$key],'Y-m-d'),
                        'end_date' => nowdate($request->end_date[$key],'Y-m-d'),
                        'text_balance' => $request->text_balance[$key],
                        'text_use_balance' => $request->text_use_balance[$key],
                        'email_balance' => $request->email_balance[$key],
                        'email_use_balance' => $request->email_use_balance[$key],
                        'app_balance' => $request->app_balance[$key],
                        'app_use_balance' => $request->app_use_balance[$key],
                        'user_id' => $request->user_id[$key],
                        'created_at' => $now,
                        'updated_at' => $now
                    ];

                    $communication=CommunicationBalance::insert($data);
                    if($communication){
                        $insertcount++;
                    }
                }catch (\Exception $e){}
            }
        }

        if($insertcount>0){
            return ['result'=>1];
        }else{
            return ['result'=>0];
        }
    }

    /*
     * developer communication balance action
     * @param CommunicationBalance $communicationbalance
     * @param Request $request
     */
    public function communicationaction(CommunicationBalance $communicationbalance,Request $request)
    {

    }


}
