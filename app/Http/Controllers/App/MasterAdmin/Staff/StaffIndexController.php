<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffIndexController extends Controller
{
    public function index()
    {
       return view('app.erpmodule.MasterAdmin.Staff.index');
    }
}
