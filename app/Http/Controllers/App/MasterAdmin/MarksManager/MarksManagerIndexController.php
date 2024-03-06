<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarksManagerIndexController extends Controller
{
    public function index(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.index');
    }
}
