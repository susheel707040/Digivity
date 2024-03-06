<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\PhoneBookContactRequest;
use App\Models\MasterAdmin\Communication\PhoneBookContact;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class PhoneBookController extends Controller
{
    public function index()
    {
        $phonebookcontact=(new CommunicationRepository())->phonebookcontactlist();
        return view('app.erpmodule.MasterAdmin.Communication.PhoneBook.define-phone-book',compact(['phonebookcontact']));
    }

    public function store(PhoneBookContactRequest $request)
    {
        PhoneBookContact::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(PhoneBookContact $phonebookcontact)
    {
        return view('app.erpmodule.MasterAdmin.Communication.PhoneBook.Edit.edit-phonebook',compact(['phonebookcontact']));
    }

    public function modify(PhoneBookContact $phonebookcontact,PhoneBookContactRequest $request)
    {
        $phonebookcontact->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Communication/EditViewPhoneBookContact/' . $phonebookcontact->id . '/view']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
