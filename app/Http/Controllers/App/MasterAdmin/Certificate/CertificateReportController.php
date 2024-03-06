<?php

namespace App\Http\Controllers\App\MasterAdmin\Certificate;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Certificate\CertificateRecord;
use App\Repositories\MasterAdmin\Certificate\CertificateRepositories;
use PDF;
use Illuminate\Http\Request;

class CertificateReportController extends Controller
{
    public function index(Request $request)
    {
        $search=$request->except('_token');
        $certificate=(new CertificateRepositories())->certificaterecordlist($search,['student']);
        return view('erpmodule.MasterAdmin.Certificate.Reports.certificate-reports',compact(['certificate']));
    }

    public function editview(CertificateRecord $certificaterecord)
    {

    }

    public function downloadpdf(CertificateRecord $certificaterecord)
    {
        $data =$certificaterecord->certificate_content;
        $pdf = PDF::loadView('Print.export-pdf-direct', compact('data'))->setPaper('A4')->setWarnings(false);
        return $pdf->download('certificate.pdf');
    }

    public function remove(CertificateRecord $certificaterecord)
    {
        try {
            $certificaterecord->update(['status'=>'inactive']);
            return back()->with('success', 'Student Certificate Remove Successful Complete');
        }catch (\Exception $e){
            return back()->with('danger', 'sorry, do not permission to create this record');
        }
    }
}
