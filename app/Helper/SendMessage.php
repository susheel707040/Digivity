<?php


namespace App\Helper;


use App\Helper\SMSCounter;
use App\Models\MasterAdmin\Communication\CommunicationSMSRecord;
use Carbon\Carbon;
use Extsalt\Otp\Facades\SMS;
use Illuminate\Support\Facades\Auth;

class SendMessage
{
    public static function pushsms($request)
    {
        $communication_token_id = GenerateTokenId::TokemId('15');
        $smsresult = ['result' => 0, 'resultbal' => 0];

        /*
         * get communication balance
         */
        $smsbalance = 0;
        $coomunicationbalance = CommunicationBalance::Balance();

        /*
         * get contact number multi tables
         */
        $getcontactno = GetContactNumber::getcontactnumber($request);
        if(isset($getcontactno)&&($getcontactno)) {
            /*
             * text sms
             */

            $other = ['communication_type_id' => null, 'unicode' => null, 'campaign_name' => null
                , 'phone_text' => 'yes', 'mobile_app' => 'yes', 'website' => 'no', 'schedule_date' => null
                , 'schedule_datetime' => null, 'schedule_status' => 'no'];

            if (isset($request["message"])) {
                $textmessage = $request["message"];
            } else {
                $textmessage = $request["text_header"] . "\n" . $request["text_message"] . "\n" . $request["text_footer"];

                $other = ['communication_type_id' => $request["communication_type_id"], 'unicode' => $request["unicode"],
                    'campaign_name' => $request["campaign_name"], 'phone_text' => $request["phone_text"]
                    , 'mobile_app' => $request["mobile_app"], 'website' => $request["website"], 'schedule_date' => null,
                    'schedule_datetime' => null, 'schedule_status' => 'no'];
            }
            /*
             * If check Auth
             */
            if (Auth::check()) {
                $school_id = auth()->user()->school_id;
                $school_branch_id = auth()->user()->branches_id;
                $academic_id = auth()->user()->academic_id;
                $user_id = auth()->user()->id;
            } else {
                $user = AuthNotLogin::Get();
                $school_id = $user ? $user->school_id : 1;
                $school_branch_id = $user ? $user->branches_id : 1;
                $academic_id = $user ? $user->academic_id : 1;
                $user_id = $user ? $user->id : 1;
            }

            $smsCounter = new SMSCounter();
            //multiple insert data
            $data = [];
            $dataparameters = collect($getcontactno['parameters']);
            foreach ($getcontactno['contactno'] as $contactnoid) {
                $contactno = explode("_", $contactnoid);
                $sendto = null;
                if (isset($contactno[1])) {
                    $sendto = $contactno[1];
                }
                $sendtoid = null;
                if (isset($contactno[2])) {
                    $sendtoid = $contactno[2];
                }
                $contactno = $contactno[0];
                /**
                 * message data parameters replace
                 */
                $parameters = $dataparameters->map->where('---id---', $contactnoid)->collapse()->shift();
                /*
                 * Addon Push Parameter Blade files
                 */
                if (isset($request['parameter_' . $contactnoid])) {
                    try {
                        if (is_array(unserialize($request['parameter_' . $contactnoid]))) {
                            $parameters = array_merge($parameters, unserialize($request['parameter_' . $contactnoid]));
                        }
                    } catch (\Exception $e) {
                    }
                }

                if ($parameters) {
                    $message = strtr($textmessage, $parameters);
                } else {
                    $message = $textmessage;
                }

                /**
                 * message count quantity use
                 */
                $totalreceiver = 1;
                $message_count = 2;
                $smscount = get_object_vars($smsCounter->count($message));
                if (count($smscount)) {
                    $other['unicode'] = $smscount['encoding'];
                    $message_count = $smscount['messages'];
                }
                $total_message_count = ($message_count * $totalreceiver);

                $data[] = [
                    'school_id' => $school_id,
                    'branches_id' => $school_branch_id,
                    'academic_id' => $academic_id,
                    'communication_token_id' => $communication_token_id,
                    'platform' => 'web',
                    'communication_date' => nowdate('', 'Y-m-d'),
                    'communication_type_id' => $other['communication_type_id'],
                    'send_to' => $sendto,
                    'send_to_id' => $sendtoid,
                    'contact_no' => $contactno,
                    'total_receiver' => $totalreceiver,
                    'unicode' => $other['unicode'],
                    'text_message' => $message,
                    'sms_count' => $message_count,
                    'sms_balance' => $total_message_count,
                    'delivery_status' => 'no',
                    'campaign_name' => $other['campaign_name'],
                    'phone_text' => $other['phone_text'],
                    'mobile_app' => $other['mobile_app'],
                    'website' => $other['website'],
                    'schedule_date' => $other['schedule_date'],
                    'schedule_date_time' => $other['schedule_datetime'],
                    'schedule_status' => $other['schedule_status'],
                    'status' => 'yes',
                    'user_id' => $user_id,
                    'created_at' => Carbon::now()
                ];
            }

            /**
             * COMMUNICATION RECORD SAVE
             */
            $communication = CommunicationSMSRecord::insert($data);

            if ($communication) {
                /**
                 * communication group text message and send message
                 */
                $communicationgroup = CommunicationSMSRecord::query()->where(['communication_token_id' => $communication_token_id])->get()->groupBy(function ($value) {
                    return $value->text_message;
                });

                foreach ($communicationgroup as $message => $communication) {

                    $contactno = collect($communication->map->contact_no)->toArray();
                    $communicationids = collect($communication->map->id)->toArray();
                    $usebalance = array_sum(collect($communication->map->sms_balance)->toArray());
                    /**
                     * sms balance deduct and add update
                     */
                    if (isset($coomunicationbalance->text_balance)) {
                        $smsbalance = $coomunicationbalance->text_balance;
                    }
                    /**
                     * sms balance if not empty
                     */
                    if ($smsresult['resultbal'] == 0) {
                        if ($smsbalance >= $usebalance) {

                            $coomunicationbalance->decrement('text_balance', $usebalance);
                            $coomunicationbalance->increment('text_use_balance', $usebalance);
                            /**
                             * if number qty more then chuck numbers
                             */
                            $contactnoarr = collect($contactno)->chunk(400)->toArray();
                            foreach ($contactnoarr as $contactno) {
                                $contactnos = implode(',', $contactno);
                                /**
                                 * sms send to vendor
                                 */
                                $result = Sms::message($contactnos, $message);
                                if ($result == 0) {
                                    CommunicationSMSRecord::query()->whereIn('id', $communicationids)->update(['delivery_status' => 'yes']);
                                } else {
                                    $smsresult['result'] += 1;
                                }
                            }
                        } else {
                            $smsresult['resultbal'] += 1;
                        }
                    }
                }

                /**
                 * if sms company balance empty then inform to company
                 */
                if ($smsresult['result'] != 0) {
                    SMSFailure::smsfailreport($communication_token_id, 'smsfail');
                }
                if ($smsresult['resultbal'] != 0) {
                    SMSFailure::smsfailreport($communication_token_id, 'smsbalance');
                }
                return $smsresult;
            }
            return ['dbfail' => 1];
        }else{
            return ['contactnull' => 1];
        }
    }

}
