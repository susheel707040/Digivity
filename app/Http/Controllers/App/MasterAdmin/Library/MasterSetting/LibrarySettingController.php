<?php

namespace App\Http\Controllers\App\MasterAdmin\Library\MasterSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibrarySettingController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Library.MasterSetting.library-configuration');
    }
}
