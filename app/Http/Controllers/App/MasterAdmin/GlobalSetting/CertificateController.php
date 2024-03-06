<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\GlobalSetting\CertificateRequest;
use App\Models\MasterAdmin\GlobalSetting\Certificate;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificate=(new CommanDataRepository())->certificatelist();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.Certificate.define-certificate',compact(['certificate']));
    }

    public function store(CertificateRequest $request)
    {
        try {

            session(['keyid' => 'addModels', 'url' => '0']);
            Certificate::create($request->all());
            return back()->with('success', 'Record Save Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

    public function editview(Certificate $certificate)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.Certificate.Edit.edit-certificate',compact(['certificate']));
    }

    public function modify(Certificate $certificate,CertificateRequest $request)
    {
        try {

            session(['keyid' => 'editModels', 'url' => '/MasterAdmin/GlobalSetting/EditViewCertificate/' . $certificate->id . '/editview']);
            $certificate->update($request->all());
            return back()->with('success', 'Record Update Successful Complete');

        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
