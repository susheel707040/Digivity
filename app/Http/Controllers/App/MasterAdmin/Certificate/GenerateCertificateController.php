<?php

namespace App\Http\Controllers\App\MasterAdmin\Certificate;

use App\Helper\DateFormat;
use App\Helper\FormNoGenerate;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Model\MasterAdmin\Certificate\CertificateRecord;
use App\Model\MasterAdmin\GlobalSetting\Certificate;
use App\Model\MasterAdmin\GlobalSetting\CertificateIntegrateForm;
use App\Model\MasterAdmin\GlobalSetting\CertificateTemplate;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class GenerateCertificateController extends Controller
{
    //Certificate Index
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

    //Certificate Entry Preview
    public function certificateentrypreview(StudentRecord $studentrecord,Certificate $certificate)
    {
        $certificateintegrateform=CertificateIntegrateForm::query()->where(['certificate_id'=>$certificate->id,'certificate_for'=>'student'])->record()->first();
        return view('erpmodule.MasterAdmin.StudentInformation.Certificate.student-generate-certificate-fields-entry',compact(['certificateintegrateform','studentrecord','certificate']));
    }

    //Certificate Generate Process
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

    //Certificate Store dynamic
    public function storefields(Request $request)
    {
        //student delete certificate previous record
        CertificateRecord::query()->where(['student_id'=>$request->student_id,'certificate_id'=>$request->certificate_id,'certificate_for'=>'student'])->record()->delete();

        $data=$request->all();
        /*
         * certificate no get auto fill
         */
        $getcertificate="certificate_no";
        if(isset($request->integrate)&&$request->integrate=="tc"){
            $getcertificate="tc_no";
        }
        if (FormNoGenerate::generate($getcertificate)) {
            $certificateno = FormNoGenerate::generate($getcertificate);
            if ($certificateno->should_be == "auto") {
                $data = array_merge($data, ['certificate_no' => $certificateno->GetNo()]);
            }
        }

        //certificate template get and replace array string
        $certificatetemplate="";
        try {
            $certificatetemplatedata=(new CommanDataRepository())->certificatetemplatelist(['certificate_id'=>$request->certificate_id])->first();
            if(isset($certificatetemplatedata->template)){
                $requestdata=[];
                foreach($data as $key=>$value){
                    if(is_array($request[$key])){
                        $value=implode(",",$request[$key]);
                    }else{$value=$request[$key];}
                    $requestdata=array_merge($requestdata,[$key=>$value]);
                }

                $requestdata=array_merge($requestdata,['{CertificateNo}'=>$data['certificate_no']]);
                $requestdata=array_merge($requestdata,['{CertificateDate}'=>$request->issue_date]);
                $requestdata=array_merge($requestdata,['{SlNo}'=>$request->sl_no]);

                $certificatetemplate=$certificatetemplatedata->template;
                $certificatetemplate=strtr($certificatetemplate,$requestdata);
            }
        }catch (\Exception $e){}

        $data = array_merge($data, ['issue_date' => nowdate($request->issue_date, 'Y-m-d')]);
        //add certificate content
        $data=array_merge($data,['certificate_content'=>$certificatetemplate]);
        //request all merge
        $data=array_merge($data,['request_data'=>serialize($request->all())]);

        //Store Certificate data
        $certificatestore=CertificateRecord::create($data);
        if($certificatestore){
            /*
             * Certificate No. Increment
             */
            if (isset($certificateno)) {
                $certificateno->increment('start_from', 1);
            }
            /*
             * Student Inactive If Generate Tc
             */
            if(isset($request->integrate)&&$request->integrate=="tc") {
                $student = StudentRecord::find($request->student_id);
                if ($student) {
                    $student->update(['status' => 'inactive']);
                }
            }
            return redirect('MasterAdmin/Certificate/CertificateView/'.$certificatestore->id.'/preview');
        }
        return back()->with('danger', 'Sorry, request failed, Please Try Again.');
        try {

        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
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
