<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeGroupRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeGroup;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FeeGroupController extends Controller
{
    public function index()
    {
        $feegroup=(new FinanceRepository())->feegrouplist([]);
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-group',compact(['feegroup']));
    }

    public function store(FeeGroupRequest $request)
    {
        FeeGroup::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(FeeGroup $feegroup)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Edit.edit-fee-group',compact(['feegroup']));
    }

    public function modify(FeeGroup $feegroup,FeeGroupRequest $request)
    {
        $feegroup->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Finance/EditViewFeeGroup/'.$feegroup->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
