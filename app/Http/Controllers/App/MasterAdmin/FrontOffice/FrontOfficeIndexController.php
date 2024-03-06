<?php

namespace App\Http\Controllers\App\MasterAdmin\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontOfficeIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.FrontOffice.index');
    }
}
