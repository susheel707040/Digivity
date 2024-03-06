<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeAccountRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeAccount;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FeeAccountController extends Controller
{
    public function index()
    {
        $feeaccount=(new FinanceRepository())->feeaccountlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-account',compact(['feeaccount']));
    }

    public function store(FeeAccountRequest $request)
    {
        FeeAccount::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(FeeAccount $feeaccount)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Edit.edit-fee-account',compact(['feeaccount']));
    }

    public function modify(FeeAccount $feeaccount,FeeAccountRequest $request)
    {
        $feeaccount->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Finance/EditViewFeeAccount/'.$feeaccount->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
