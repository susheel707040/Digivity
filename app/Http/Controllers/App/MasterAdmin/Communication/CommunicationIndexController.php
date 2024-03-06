<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Helper\CommunicationBalance;
use App\Helper\GetContactNumber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunicationIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule/MasterAdmin/Communication/index');
    }

    public function getinfo(Request $request)
    {
        // dd($request->all());
       $getcontactno=GetContactNumber::getcontactnumber($request);
       $totalreceiver=0;
       if(isset($getcontactno['contactno'])){
           $totalreceiver=count($getcontactno['contactno']);
       }
       $communicationbalance=0;
       $communication=CommunicationBalance::Balance();
       if(isset($communication->text_balance)){
           $communicationbalance=$communication->text_balance;
       }
       return ['total_receiver'=>$totalreceiver,'communication_balance'=>$communicationbalance];
    }
}
