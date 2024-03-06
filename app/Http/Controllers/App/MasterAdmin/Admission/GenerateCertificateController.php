<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Helper\DateFormat;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Certificate\CertificateRecord;
use App\Models\MasterAdmin\GlobalSetting\Certificate;
use App\Models\MasterAdmin\GlobalSetting\CertificateIntegrateForm;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class GenerateCertificateController extends Controller
{
    public function index(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        try {
            $certificate=(new CommanDataRepository())->certificatelist(['id'=>$request->certificate_id])->first();
        }catch (\Exception $e){
            $certificate=[];
        }
        return view('erpmodule.MasterAdmin.StudentInformation.Certificate.student-certificate',compact(['student','certificate']));
    }

    public function certificateentrypreview(StudentRecord $studentrecord,Certificate $certificate)
    {
        $certificateintegrateform=CertificateIntegrateForm::query()->where(['certificate_id'=>$certificate->id,'certificate_for'=>'student'])->record()->first();
        return view('erpmodule.MasterAdmin.StudentInformation.Certificate.student-generate-certificate-fields-entry',compact(['certificateintegrateform','studentrecord','certificate']));
    }

    public function certificatepreview(StudentRecord $studentrecord,Certificate $certificate)
    {
        $certificateintegrateform=CertificateIntegrateForm::query()->where(['certificate_id'=>$certificate->id,'certificate_for'=>'student'])->record()->first();
        if((isset($certificateintegrateform))&&($certificateintegrateform)){
            return redirect('MasterAdmin/StudentInformation/GenerateCertificate/'.$studentrecord->id.'/'.$certificate->id.'/entry');
        }
        $certificateintegrateform=CertificateIntegrateForm::query()->where(['certificate_id'=>$certificate->id,'certificate_for'=>'student'])->record()->first();
        $certificatetemplate=(new CommanDataRepository())->certificatetemplatelist(['certificate_id'=>$certificate->id])->first();

        return view('erpmodule.MasterAdmin.StudentInformation.Certificate.student-generate-certificate',compact(['certificateintegrateform','studentrecord','certificate','certificatetemplate']));
    }

    public function storefields(Request $request)
    {

    }

    /*
     * Certificate Store
     */
    public function certificatestore(Request $request)
    {
        try {
            CertificateRecord::query()->where(['student_id'=>$request->student_id,'certificate_id'=>$request->certificate_id,'certificate_for'=>'student'])->record()->forceDelete();
            CertificateRecord::create($request->all());
            return back()->with('success', 'Certificate save successful Complete.');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }

}
