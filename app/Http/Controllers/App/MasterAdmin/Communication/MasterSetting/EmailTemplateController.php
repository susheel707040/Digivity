<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\EmailTemplateRequest;
use App\Models\MasterAdmin\Communication\EmailTemplate;
use App\Model\MasterAdmin\Communication\SMSTemplate;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $emailtemplate=(new CommunicationRepository())->emailtemplatelist();
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.define-email-template',compact(['emailtemplate']));
    }

    public function store(EmailTemplateRequest $request)
    {
        EmailTemplate::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(EmailTemplate $emailtemplate)
    {
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.Edit.edit-email-template',compact(['emailtemplate']));
    }

    public function modify(EmailTemplate $emailtemplate,EmailTemplateRequest $request)
    {
        $emailtemplate->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Communication/EditViewEmailTemplate/'.$emailtemplate->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
