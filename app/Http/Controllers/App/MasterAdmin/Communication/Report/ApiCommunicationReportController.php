<?php

namespace App\Http\Controllers\MasterAdmin\Communication\Report;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Communication\CommunicationSMSRecord;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Models\User;
use Illuminate\Http\Request;

class ApiCommunicationReportController extends Controller
{
    /*
     * Communication Mobile App Api SMS Report
     */
    public function communicationindexreport($userid,Request $request)
    {
        $communicationlist = [];
        try {
            $datesearch = [nowdate($request->from_date, 'Y-m-d'), nowdate($request->to_date, 'Y-m-d')];
            $communication = CommunicationSMSRecord::query()->search(['search' => $request->all(), 'customsearch' => ['whereBetween' => ['communication_date' => $datesearch]]])->with(['communicationtype'])->record()->orderBy('id', 'desc')->get()->groupBy('communication_token_id');
            if(isset($communication)&&(count($communication)>0)) {
                foreach ($communication as $key => $communicationdata) {
                    $communicationlist[] = [
                        'communication_type' => $communicationdata->last()->CommunicationTypeName(),
                        'communication_token_id' => $key,
                        'total_receiver' => $communicationdata->sum('total_receiver'),
                        'total_sms' => $communicationdata->sum('sms_balance'),
                        'message' => $communicationdata->last()->text_message,
                        'date' => nowdate($communicationdata->last()->communication_date, 'd-M-Y'),
                        'delivery_status' => $communicationdata->last()->delivery_status,
                        'deliver' => count($communicationdata->where('delivery_status', 'yes')),
                        'awating' => count($communicationdata->where('delivery_status', 'no'))
                    ];
                }
            }
            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => $communicationlist
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'result' => 0,
                'message' => 'sorry, technical problem',
                'success' => []
            ], 200);

        }
    }

    public function communicationidreport($userid,$communicationtokenid)
    {
        $communication=(new CommunicationRepository())->communicationsmsreport(['communication_token_id'=>$communicationtokenid]);
        $pageview=view('erpmodule.MasterAdmin.reports.ApiWebViewReport.Communication.api-communication-report-view',compact(['communication']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[[
                'data'=>$pageview
            ]]
        ],200);
    }

    public function apinotificationreport($selectuserid,$selectuser)
    {
        $user=User::find($selectuserid);
        $contactno="";
        if($selectuser=="student"){
            $userdata=(new StudentRepository())->studentshortlist(['student_id'=>$user->student_id])->first();
            $selectuserid=$userdata->student_id;
        }elseif($selectuser=="staff"){
            $userdata=(new StaffRepositories())->staffshortlist(['id'=>$user->staff_id])->first();
            $selectuserid=$userdata->id;
        }

        $communicationlist=(new CommunicationRepository())->communicationsmsreport(['send_to'=>$selectuser,'send_to_id'=>$selectuserid])->map(function ($data){
            return [
              'communication_id'=>$data->id,
              'message'=>$data->text_message,
              'sent_on'=>nowdate($data->created_at,'d-M-Y h:i:sA'),
              'submitted_by'=>$data->user ? $data->user->fullName() : "",
              'submitted_by_profile'=>$data->user ? $data->user->ProfileImage() : "",
            ];
        });

        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$communicationlist
        ],200);
    }

}
