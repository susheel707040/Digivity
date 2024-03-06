<?php

namespace App\Http\Controllers\App\MasterAdmin\Certificate;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Certificate\CertificateRecord;
use Illuminate\Http\Request;

class CertificatePreviewController extends Controller
{
    public function index(CertificateRecord $certificaterecord)
    {
        if($certificaterecord){
            return view('erpmodule.MasterAdmin.Certificate.certificate-preview',compact(['certificaterecord']));
        }
        return back()->with('danger','Record No Found');

    }

}
