<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FineSettingRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FineSetting;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FineSettingController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.fine-setting');
    }

    public function indexsearch($feegroupid)
    {
        $finesetting = (new FinanceRepository())->finesettinglist(['fee_group_id'=>$feegroupid]);

        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.fine-setting', compact(['finesetting']));
    }

    public function store(FineSettingRequest $request)
    {
        $request->validated();

        foreach ($request->fee_head_id as $fee_head_id) {

            FineSetting::query()->where(['fee_group_id' => $request->fee_group_id])->record()->forceDelete();
            foreach ($request["fee_head_" . $fee_head_id . "_instalment_id"] as $instalment_id) {
                $datainsert = [
                    'fee_group_id' => $request->fee_group_id,
                    'fee_head_id' => $fee_head_id,
                    'foreign_fee_head_id'=>$fee_head_id,
                    'instalment_id' => $instalment_id,
                    'fine_type' => $request["fine_type_" . $fee_head_id . "_" . $instalment_id . "_id"],
                    'instalment_max_limit' => $request["max_fine_limit_" . $fee_head_id . "_" . $instalment_id . "_id"],
                    'fine_max_limit' => $request["fee_head_" . $fee_head_id . "_fine_max_limit"]
                ];
                FineSetting::create($datainsert);
            }
        }
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function fineremove($feegroupid)
    {
        FineSetting::query()->where(['fee_group_id' => $feegroupid])->record()->forceDelete();
        return back()->with('danger', 'Record Delete Successful Complete');
    }

}
