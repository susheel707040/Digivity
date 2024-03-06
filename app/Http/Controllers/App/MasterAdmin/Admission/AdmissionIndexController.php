<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Helper\SMSFailure;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdmissionIndexController extends Controller
{
    public function index()
    {
        //SMSFailure::smsfailreport('112','fail');
        return view('app.erpmodule.MasterAdmin.StudentInformation.index');
    }
}
