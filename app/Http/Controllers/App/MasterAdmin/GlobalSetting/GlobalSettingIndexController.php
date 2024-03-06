<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlobalSettingIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.index');
    }
}
