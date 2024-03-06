<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeStrutureRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructureInstalment;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeeStrutureController extends Controller
{
    public function index()
    {
        $feestructure = [];
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-structure', compact(['feestructure']));
    }

    public function indexsearch($feegroupid)
    {
        $feestructure = collect((new FinanceRepository())->feeheadstructurelist(['fee_group_id'=>$feegroupid]));
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-structure', compact(['feestructure']));
    }

    public function feestructureindex($feeheadid)
    {
        if($feeheadid) {
            $feehead = (new FinanceRepository())->feeheadlist(['id' => $feeheadid])->first();
            $feeheadinstalemnt=feeheadinstalmentlist(['fee_head_id'=>$feeheadid]);
            if(count($feeheadinstalemnt)>0) {
                return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.fee-structure-integrate-ajax', compact(['feehead']));
            }
            return 0;
        }
        return "<h3 class='text-danger'>Sorry, Technical problem</h3>";
    }

    public function store(FeeStrutureRequest $request)
    {
        $request->validated();

        foreach ($request['key_id'] as $keyid) {

            $feeheadid=$request["fee_head_id_".$keyid.""];
            $fee_applicable=$request["fee_applicable_" . $keyid . "_id"];
            $admission_category=$request["admission_category_".$keyid."_id"];
            $fee_structure_id=null;
            if(isset($request["fee_structure_".$keyid."_id"])){
                $fee_structure_id=$request["fee_structure_".$keyid."_id"];
            }

            $feestructureid=FeeStructure::query()->where(['id'=>$fee_structure_id,'fee_group_id' => $request->fee_group_id, 'fee_to' => 'group','fee_head_id'=>$feeheadid])->record()->first();
            if($feestructureid){
                FeeStructureInstalment::query()->where(['fee_head_structure_id' => $feestructureid->id])->forceDelete();
                $feestructureid->update(['fee_applicable'=>$fee_applicable,'admission_category'=>$admission_category]);
            }else {
                $data = [
                    'fee_to' => 'group',
                    'fee_group_id' => $request->fee_group_id,
                    'fee_applicable' => $fee_applicable,
                    'admission_category' => $admission_category,
                    'fee_head_id' => $feeheadid,
                    'fee_type' => $request["fee_type_" . $keyid . "_id"],
                    'foreign_fee_head_id' => $feeheadid
                ];
                $feestructureid = FeeStructure::create($data);
            }

            foreach ($request["instalment_" . $keyid . "_id"] as $instalmentid) {
                $data1 = [
                    'fee_head_structure_id' => $feestructureid->id,
                    'fee_group_id' => $request->fee_group_id,
                    'fee_head_id' => $feeheadid,
                    'instalment_id' => $instalmentid,
                    'fee_amount' => $request["fee_amount_" . $keyid . "_" . $instalmentid . "_id"],
                ];
                $feestructureinstalment=FeeStructureInstalment::create($data1);
            }
        }
        return back()->with('success', 'Record Save Successful  Complete');
    }

    public function feestructureremove($id)
    {
        $rmfeestructure=FeeStructure::query()->where(['id'=>$id])->record()->first();
        if($rmfeestructure){
            //FeeStructureInstalment::query()->where(['fee_head_structure_id' => $rmfeestructure->id])->forceDelete();
            $rmfeestructure->delete();
            return back()->with('success', 'Record Remove Successful Complete');
        }
         return back()->with('danger', 'Sorry, Request failed, Please try again');
    }
}
