<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Requests\Admin\AcademicSessionRequest;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcademicYearController extends Controller
{
    public function academicyearview()
    {
        $academic=AcademicSession::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.define-academic-year',compact(['academic']));
    }

    public function editviewacademicyear(AcademicSession $academic)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.schoolsetting.Edit.edit-academic-year',compact(['academic']));
    }

    public function storeacademic(AcademicSessionRequest $request)
    {
        session(['keyid' => 'addModels','url'=>'0']);
        AcademicSession::create($request->validated());
        return back()->with('success','Record Create Successful Complete');
    }

    public function editacademicyear(AcademicSession $academic,AcademicSessionRequest $academicSessionRequest)
    {
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/GlobalSetting/EditViewAcademicYear/'.$academic->id.'/edit']);
        $academic->update($academicSessionRequest->validated());
        return back()->with('success','Record Update Successful Complete');
    }
}
