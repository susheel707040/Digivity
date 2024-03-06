<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunicationViewPageController extends Controller
{
    public function smstemplateindex()
    {
        return view('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-template');
    }

    public function smstypingindex()
    {
        return view('app.erpmodule.MasterAdmin.Communication.PagePlugin.hindi-typing');
    }

    public function headerandfooterindex()
    {
       return view('app.erpmodule.MasterAdmin.Communication.PagePlugin.fix-header-footer');
    }
}
