<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\PaymodeRequest;
use App\Models\MasterAdmin\Finance\Paymode;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class PaymodeController extends Controller
{
    public function index()
    {
        $paymode=(new FinanceRepository())->paymodelist();
        // dd($paymode);
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.AccountSetting.define-paymode',compact(['paymode']));
    }

    public function store(PaymodeRequest $request)
    {
        Paymode::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(Paymode $paymode)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.AccountSetting.Edit.edit-paymode',compact(['paymode']));
    }

    public function modify(Paymode $paymode,PaymodeRequest $request)
    {
        $paymode->update($request->validated());
        session(['keyid' => 'editModels','url'=>'MasterAdmin/Finance/EditViewPaymode/'.$paymode->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
