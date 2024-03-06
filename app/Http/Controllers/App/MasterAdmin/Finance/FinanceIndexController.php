<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Extsalt\Otp\Facades\SMS;
use Illuminate\Http\Request;

class FinanceIndexController extends Controller
{
    public function index()
    {
      $course=(new CommanDataRepository())->coursesectionlist([]);
      $section=(new CommanDataRepository())->sectionlist([]);
      $paymode=(new FinanceRepository())->paymodelist([]);
      return view('app.erpmodule.MasterAdmin.Finance.index',compact(['course','section','paymode']));
    }
}
