<?php

namespace App\Http\Controllers\App\MasterAdmin\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Attendance.index');
    }
}
