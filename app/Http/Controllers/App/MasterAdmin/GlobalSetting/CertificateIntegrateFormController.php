<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\GlobalSetting\CertificateIntegrateForm;
use Illuminate\Http\Request;

class CertificateIntegrateFormController extends Controller
{
    public function index(Request $request)
    {
        $exist_data=""; $certificate_for=""; $certificate_id="";
        if(($request->certificate_id)&&($request->certificate_for)){
            $certificateintegrateform=CertificateIntegrateForm::query()->where(['certificate_id'=>$request->certificate_id,'certificate_for'=>$request->certificate_for])->record()->first();
            if(isset($certificateintegrateform->input)){
                $exist_data=$certificateintegrateform->input;
            }
        }

        return view('app.erpmodule.MasterAdmin.GlobalSetting.Certificate.certificate-integrate-form',compact(['certificate_id','certificate_for','exist_data']));
    }

    public function store(Request $request)
    {
        $data = [
            'certificate_id' => $request->certificate_id,
            'certificate_for' => $request->certificate_for,
            'input'=>serialize($request->except(['_token','certificate_id','certificate_for']))
        ];
        CertificateIntegrateForm::query()->where(['certificate_id'=>$request->certificate_id,'certificate_for'=>$request->certificate_for])->record()->forceDelete();
        CertificateIntegrateForm::create($data);
        try {

            return back()->with('success', 'Record Save Successful Complete')->withInput($request->all());
        } catch (\Exception $e) {
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

}
