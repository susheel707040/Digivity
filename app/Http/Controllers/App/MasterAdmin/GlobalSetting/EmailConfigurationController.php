<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailConfigurationController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.email-configuration');
    }

    public function store()
    {

    }
}
