<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\CommunicationTypeRequest;
use App\Models\MasterAdmin\Communication\CommunicationType;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class CommunicationTypeController extends Controller
{
    public function index()
    {
        $communicationtype=(new CommunicationRepository())->comunicationtypelist();
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.define-communication-type',compact('communicationtype'));
    }

    public function store(CommunicationTypeRequest $request)
    {
        CommunicationType::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(CommunicationType $communicationtype)
    {
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.edit.edit-communication-type',compact('communicationtype'));
    }

    public function modify(CommunicationType $communicationtype,CommunicationTypeRequest $request)
    {
        $communicationtype->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Communication/EditViewCommunicationType/'.$communicationtype->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
