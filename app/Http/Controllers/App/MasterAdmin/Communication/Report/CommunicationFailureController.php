<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\Report;

use App\Helper\CommunicationBalance;
use App\Helper\SMSFailure;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Communication\CommunicationSMSRecord;
use Extsalt\Otp\Facades\SMS;
use Illuminate\Http\Request;

class CommunicationFailureController extends Controller
{
    public function apiindex(Request $request)
    {
        if(isset($request->communicationid)&&($request->communicationid)){
            $communicationreport=CommunicationSMSRecord::query()->where(['communication_token_id'=>$request->communicationid])->get();
        }
        return view('erpmodule.MasterAdmin.Communication.Reports.web-api-communication-report',compact(['communicationreport']));
    }

    public function failureresend(Request $request)
    {
        $sendsuccess=0;
        $balcheck=0;
        //dd($request->all());
        if(count($request->all())>0){
            $communicationids=explode(",",$request->communicationid);
            if(is_array($communicationids)&&(count($communicationids)>0)) {
                $communication = CommunicationSMSRecord::query()->whereIn('id',$communicationids)->where(['delivery_status'=>'no'])->get();
                $submitcommunicationids=[];
                if(isset($communication)&&($communication)) {
                    foreach ($communication as $communicationdata) {
                        //smsbalance means school balance empty -- deduct school balance
                        if ($request->reason == "smsbalance") {
                            $coomunicationbalance = CommunicationBalance::Balance();
                            if((isset($coomunicationbalance->text_balance))&&is_numeric($coomunicationbalance->text_balance)&&($coomunicationbalance->text_balance>0)) {
                                $result = SMS::message($communicationdata->contact_no, $communicationdata->text_message);
                                if ($result == 0) {
                                    $coomunicationbalance->decrement('text_balance', $communicationdata->sms_balance);
                                    $coomunicationbalance->increment('text_use_balance', $communicationdata->sms_balance);
                                    $sendsuccess++;
                                }
                            }else{$balcheck++; }
                        } elseif ($request->reason == "smsfail") {
                            $result = SMS::message($communicationdata->contact_no, $communicationdata->text_message);
                            if ($result == 0) {
                                $sendsuccess++;
                            }
                        }
                        if (isset($sendsuccess) && ($sendsuccess > 0)) {
                            array_merge($submitcommunicationids, [$communicationdata->id]);
                            //update
                            $communicationdata->update(['delivery_status' => 'yes']);
                        }
                    }
                    if($balcheck==0) {
                        if (count($communicationids) != $sendsuccess) {
                            SMSFailure::smsfailreport($communicationdata->communication_token_id, $request->reason);
                        }
                        return response()->json([
                            'result' => 1,
                            'status' => 'success',
                            'message' => 'Your message has been sent successfully.',
                            'data' => [
                                'communicationids' => implode(",", $communicationids),
                                'request' => count($communicationids),
                                'deliver' => $sendsuccess
                            ]
                        ]);
                    }else{
                        return response()->json([
                            'result'=>0,
                            'status'=>'danger',
                            'message'=>'Please first sms recharge in client account.',
                            'data'=>null
                        ]);
                    }
                }
                return response()->json([
                    'result'=>0,
                    'status'=>'danger',
                    'message'=>'Sorry, this message has already been sent, now do not send it through',
                    'data'=>null
                ]);
            }
        }
        return response()->json([
            'result'=>0,
            'status'=>'danger',
            'message'=>'I did not find any data in the request. Please send it to you.',
            'data'=>null
        ]);
    }
}
