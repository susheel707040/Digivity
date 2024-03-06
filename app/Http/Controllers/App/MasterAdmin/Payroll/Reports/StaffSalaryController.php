<?php

namespace App\Http\Controllers\MasterAdmin\Payroll\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffSalaryController extends Controller
{
    /*
     * Mobile Application api
     */
    public function apimysalary()
    {
        return response()->json([
            'result'=>0,
            'message'=>'sorry, data no found!',
            'success'=>[]
        ],400);
    }
}
