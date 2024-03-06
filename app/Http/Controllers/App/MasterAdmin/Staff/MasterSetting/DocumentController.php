<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\DocumentRequest;
use App\Models\MasterAdmin\Staff\Document;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $document=(new StaffRepositories())->staffdocumentlist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-document-type',compact(['document']));
    }

    public function store(DocumentRequest $request)
    {
        Document::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(Document $document)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-document-type',compact(['document']));
    }

    public function modify(Document $document,DocumentRequest $request)
    {
        $document->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewDocument/' . $document->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');

    }
}
