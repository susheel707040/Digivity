<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\GlobalSetting\CertificateTemplateRequest;
use App\Models\MasterAdmin\GlobalSetting\CertificateTemplate;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateTemplateController extends Controller
{
    public function index(Request $request)
    {

        $certificate=[];
        if($request->certificate_id) {
            $certificate = (new CommanDataRepository())->certificatelist(['id' => $request->certificate_id])->first();
        }
        $certificatetemplate=(new CommanDataRepository())->certificatetemplatelist(['certificate_id'=>$request->certificate_id,'certificate_title_slug'=>$request->certificate_title_slug])->first();

        return view('app.erpmodule.MasterAdmin.GlobalSetting.Certificate.certificate-template',compact(['certificatetemplate','certificate']));
    }

    public function store(CertificateTemplateRequest $request)
    {
        try {

            CertificateTemplate::query()->where(['certificate_id'=>$request->certificate_id,'certificate_title_slug'=>$request->certificate_template_id])->record()->forceDelete();
            $data=$request->all();
            $data['certificate_title_slug']=strtolower(Str::slug($request->certificate_title));
            CertificateTemplate::create($data);
            return back()->with('success', 'Record Save Successful Complete')->withInput($request->all());

        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }


}
