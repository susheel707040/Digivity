<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\SMSTemplateRequest;
use App\Models\MasterAdmin\Communication\SMSTemplate;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class SMSTemplateController extends Controller
{
    public function index()
    {
        $smstemplate=(new CommunicationRepository())->smstemplatelist([]);
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.define-sms-template',compact(['smstemplate']));
    }

    public function store(SMSTemplateRequest $request)
    {
        SMSTemplate::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(SMSTemplate $smstemplate)
    {
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.edit.edit-sms-template',compact(['smstemplate']));
    }

    public function modify(SMSTemplate $smstemplate,SMSTemplateRequest $request)
    {
        $smstemplate->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Communication/EditViewSMSTemplate/'.$smstemplate->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }

}
