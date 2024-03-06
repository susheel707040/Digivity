<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeeUploadDepositBankController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.FeeEntry.bank-fee-deposit-entry');
    }

    public function store()
    {

    }
}
