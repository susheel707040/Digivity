<?php


namespace App\Helper;

use App\Helper\SMSTemplate;

trait AutoSendSMSNotification
{

    public static function smsnotification($pageid = null, $model = null, $input = null)
    {
        /*
         * Get SMS Template
         */
        $messagetemplate = SMSTemplate::getsmsbyid($pageid);
        if (isset($messagetemplate) && ($messagetemplate)) {

            if (isset($input['search']) && ($input['search']) && isset($model) && ($model)) {
                /*
                 * Model get records
                 */
                $modeldata = $model::query()->search($input['search'])->get();

                if (isset($modeldata) && ($modeldata)) {

                    foreach ($modeldata as $thismodel) {
                        $contactno = $thismodel->ContactNo();
                        if (isset($contactno) && ($contactno) && (is_numeric($contactno))) {
                            $parameter = [];
                            if ($thismodel->parameters()) {
                                $parameter = array_merge($parameter, $thismodel->parameters());
                            }

                            $message = $messagetemplate->template;

                            if ((isset($message)) && ($message) && (isset($contactno)) && ($contactno)) {
                                //message replace string
                                $message = strtr($message, $parameter);
                                $result = SendMessage::pushsms(['contactno' => $contactno, 'message' => $message]);
                            }
                        }
                    }

                    }
                    return response()->json([
                        'result' => 1,
                        'message' => 'Notification Send Successfully.'
                    ]);
                }
        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Request failed, Please try again.'
        ]);
    }

}
