<?php

namespace App\Http\Controllers\APp\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnlineFeeSettlementController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.online-fee-receipt-settlement');
    }

    public function store()
    {

    }
}
