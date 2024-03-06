<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeHeadRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHead;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index()
    {
        $feehead =(new FinanceRepository())->feeheadlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-head', compact(['feehead']));
    }

    public function store(FeeHeadRequest $request)
    {
        FeeHead::create($request->validated());
        session(['keyid' => 'addModels', 'url' => '0']);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(FeeHead $feehead)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Edit.edit-fee-head', compact(['feehead']));
    }

    public function modify(FeeHead $feehead,FeeHeadRequest $request)
    {
        $feehead->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Finance/EditViewFeeHead/'.$feehead->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
