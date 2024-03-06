<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeeCollectionSetting extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.fee-collection-setting');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
