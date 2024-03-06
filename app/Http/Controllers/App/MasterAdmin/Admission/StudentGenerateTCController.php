<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentGenerateTCController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.Certificate.student-tc-certificate');
    }
}
