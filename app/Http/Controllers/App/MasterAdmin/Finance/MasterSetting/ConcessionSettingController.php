<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\ConcessionSettingRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\ConcessionSetting;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class ConcessionSettingController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.concession-setting');
    }

    public function indexsearch($concessiontype)
    {
        $feehead = (new FinanceRepository())->feeheadwithinstalmentlist(['fee_custom'=>'no']);
        $feeheadconcession=(new FinanceRepository())->concessionassignsettinglist(['concession_type_id'=>$concessiontype]);
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.concession-setting', compact(['feehead','feeheadconcession']));
    }

    public function store(ConcessionSettingRequest $request)
    {
        $request->validated();
        foreach ($request->fee_head_id as $fee_head_id) {
            if (isset($request["instalment_" . $fee_head_id . "_id"])) {
                foreach ($request["instalment_" . $fee_head_id . "_id"] as $instalment_id) {
                    //delete old concession
                    ConcessionSetting::query()->where(['concession_type_id' => $request->concession_type_id, 'fee_head_id' => $fee_head_id, 'instalment_id' => $instalment_id])->record()->forceDelete();
                    $datainsert = [
                        'concession_type_id' => $request->concession_type_id,
                        'fee_head_id' => $fee_head_id,
                        'foreign_fee_head_id'=> $fee_head_id,
                        'instalment_id' => $instalment_id,
                        'concession_type' => $request["concession_type_" . $fee_head_id . "_" . $instalment_id . "_id"],
                        'concession' => $request["concession_" . $fee_head_id . "_" . $instalment_id . "_id"],
                    ];
                    ConcessionSetting::create($datainsert);
                }
            }
        }
        return back()->with('success', 'Record Save Successful Complete');
    }
}
