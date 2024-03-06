<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\PhoneBookGroupRequest;
use App\Models\MasterAdmin\Communication\PhoneBookGroup;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class PhoneBookGroupController extends Controller
{
    public function index()
    {
      $phonebookgroup=(new CommunicationRepository())->phonebookgrouplist();
      return view('app.erpmodule.MasterAdmin.Communication.PhoneBook.define-group',compact(['phonebookgroup']));
    }

    public function store(PhoneBookGroupRequest $request)
    {
        PhoneBookGroup::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(PhoneBookGroup $phonebookgroup)
    {
        return view('app.erpmodule.MasterAdmin.Communication.PhoneBook.Edit.edit-group',compact(['phonebookgroup']));
    }

    public function modify(PhoneBookGroup $phonebookgroup,PhoneBookGroupRequest $request)
    {
        $phonebookgroup->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Communication/EditViewPhoneBookGroup/' . $phonebookgroup->id . '/view']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
