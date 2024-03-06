<?php

namespace App\Http\Controllers\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificateSettingController extends Controller
{
    public function index()
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.Certificate.certificate-setting');
    }

}
