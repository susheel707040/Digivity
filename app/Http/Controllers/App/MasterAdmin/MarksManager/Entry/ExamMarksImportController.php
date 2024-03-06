<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamMarksImportController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.Entry.exam-marks-import');
    }


}
