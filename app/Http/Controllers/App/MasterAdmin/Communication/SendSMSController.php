<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Helper\SendMessage;
use App\Helper\SendSMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\SendSMSRequest;
use Illuminate\Http\Request;

class SendSMSController extends Controller
{
    public function composeindex()
    {
        $inputchecked=0;
        return view('app.erpmodule.MasterAdmin.Communication.compose-and-bulk-sms',compact(['inputchecked']));
    }

    public function bulkindex()
    {
        $inputchecked=1;
        return view('app.erpmodule.MasterAdmin.Communication.compose-and-bulk-sms',compact(['inputchecked']));
    }

    public function modalsmsindex()
    {
        return view('app.erpmodule.MasterAdmin.Communication.modal-sms-index');
    }

    public function individualsmsinbox()
    {
        return view('app.erpmodule.MasterAdmin.Communication.individual-sms');
    }

    public function sendsms(SendSMSRequest $request)
    {
       $smsmessage=SendMessage::pushsms($request);
       if($smsmessage['resultbal']==0){
           return back()->with('success','Message Send Successful Complete');
       }else{
           return back()->with('danger','Sorry, Message limit exceed, Please Recharge');
       }
    }

    /*
     * Mobile Application Controller
     */

    public function apisendsms(Request $request)
    {
        if(isset($request->send_to_student)&&(isset($request->send_to_student))){
            $coursesectionid=explode(",",$request->send_to_student);
            if(is_array($coursesectionid)&&(count($coursesectionid)>0)) {
                $newrequest = [
                    'coursesectionid' => $coursesectionid,
                    'message' => $request->message,
                    'phone_text' => $request->phone_sms,
                    'mobile_app' => $request->mobile_app,
                    'website' => $request->website
                ];
                $smsmessage=SendMessage::pushsms($newrequest);
                if($smsmessage['resultbal']==0){
                    return response()->json([
                        'result'=>1,
                        'message'=>'Message has been sent successfully.',
                        'success'=>null
                    ],200);
                }
                return response()->json([
                    'result'=>2,
                    'message'=>'Sorry, Message limit exceed, Please Recharge',
                    'success'=>null
                ],200);
            }
        }
        return response()->json([
            'result'=>0,
            'message'=>'Sorry, Request failed, Please try again.',
            'success'=>null
        ],200);
    }

}
