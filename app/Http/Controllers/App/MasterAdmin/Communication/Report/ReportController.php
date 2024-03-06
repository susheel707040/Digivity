<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\Report;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Communication\CommunicationSMSRecord;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $datesearch=[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')];
        $communication=CommunicationSMSRecord::query()->search(['search'=>$request->all(),'customsearch'=>['whereBetween'=>['communication_date'=>$datesearch]]])->with(['communicationtype'])->record()->orderBy('id','desc')->get()->groupBy('communication_token_id');
        return view('app.erpmodule.MasterAdmin.Communication.Reports.communication-report',compact(['communication']));
    }

    public function indexsearch($communicationtokenid)
    {
        $communication=CommunicationSMSRecord::query()->where('communication_token_id',$communicationtokenid)->with(['communicationtype'])->get();
        return view('app.erpmodule.MasterAdmin.Communication.Reports.communication-report-view',compact(['communication','communicationtokenid']));
    }

    public function webapicommunication($communicationid)
    {
        $communicationreport=(new CommunicationRepository())->communicationsmsreport(['communication_token_id'=>$communicationid]);
        return view('app.erpmodule.MasterAdmin.Communication.Reports.web-api-communication-report',compact(['communicationreport']));
    }

}
