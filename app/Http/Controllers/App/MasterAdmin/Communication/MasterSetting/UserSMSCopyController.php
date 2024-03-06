<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\UserSMSCopyRequest;
use App\Models\MasterAdmin\Communication\UserSMSCopy;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class UserSMSCopyController extends Controller
{
    public function index()
    {
        $usersmscopy = (new CommunicationRepository())->usersmscopylist();
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.define-user-sms-copy', compact('usersmscopy'));
    }

    public function store(UserSMSCopyRequest $request)
    {
        UserSMSCopy::create($request->validated());
        session(['keyid' => 'addModels', 'url' => '0']);
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function editview(UserSMSCopy $usersmscopy)
    {
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.edit.edit-user-sms-copy', compact('usersmscopy'));
    }

    public function modify(UserSMSCopy $usersmscopy, UserSMSCopyRequest $request)
    {
        $usersmscopy->update($request->validated());
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/Communication/EditViewUserSMSCopy/' . $usersmscopy->id . '/view']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
