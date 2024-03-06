<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Helper\AutoSendSMSNotification;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use Illuminate\Http\Request;

class AutoSendSMSController extends Controller
{
    use AutoSendSMSNotification;
    public function autosend($pageid,$ids)
    {
       if($pageid=="fee-submit") {
           return $this->smsnotification($pageid,StudentFeeCollection:: class, ['search' => ['receipt_group_token_id' => $ids,'receipt_status'=>'paid']]);
       }
    }

}
