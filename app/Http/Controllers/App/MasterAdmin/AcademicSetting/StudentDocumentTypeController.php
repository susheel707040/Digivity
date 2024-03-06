<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MasterAdmin\AcademicSetting\StudentDocumentTypeRequest;
use App\Models\MasterAdmin\AcademicSetting\StudentDocumentType;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;


class StudentDocumentTypeController extends Controller
{
    public function index()
    {
        $documenttype=(new CommanDataRepository())->studentdocumenttypelist([]);
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-student-document-type',compact(['documenttype']));
    }

    public function store(StudentDocumentTypeRequest $request)
    {
        StudentDocumentType::create($request->validated());
        session(['keyid'=>'addModels','url'=>0]);
        return Redirect::route('define.document.type')->with('success', 'Document Type saved successfully');
    }

    public function editview(StudentDocumentType $documenttype)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-student-document-type',compact(['documenttype']));
    }

    public function modify(StudentDocumentType $documenttype,StudentDocumentTypeRequest $request)
    {
        $documenttype->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/StudentInformation/EditViewDocumentType/'.$documenttype->id.'/edit']);
        return back()->with('success','Record update successful complete');
    }
}
