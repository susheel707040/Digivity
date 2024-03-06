<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterUpdate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentFeeModifyController extends Controller
{
    public function index(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterUpdate.student-opening-other-fee-modify');
    }

    public function modify()
    {

    }
}
