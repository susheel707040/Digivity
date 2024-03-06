<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IDCardTemplateController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.id-card-template');
    }
}
