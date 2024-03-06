<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class FeeOpeningBalanceController extends Controller
{
    public function index(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        $feestructure=(new FinanceRepository())->feeheadstructurelist(['fee_to'=>'student','custom_fee_id'=>null]);
        return view('app.erpmodule.MasterAdmin.Finance.Report.student-opening-balance-details',compact(['student']));
    }
}
