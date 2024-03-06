<?php


namespace App\Http\Controllers\MasterAdmin\Finance\Helper;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeHeadInstallment;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeStructureInstalment;
use Illuminate\Http\Request;

class CustomFeeStore
{
    public static function storefee($studentid,$payid,$request)
    {
        $feeheadid=$request["student_" . $studentid . "_fee_head_id"];
        $data1 = [
            'fee_to' => 'student',
            'fee_group_id' => null,
            'student_id' => $studentid,
            'fee_head_id' => $feeheadid,
            'foreign_fee_head_id'=>$feeheadid,
            'fee_amount'=>$request["student_".$studentid."_fee_head_amount"],
            'custom_fee_id' => $feeheadid,
            'custom_fee_pay_status' => null
        ];
        $feestructure = FeeStructure::create($data1);
        if($feestructure) {
            $foreign_fee_head_id = $feeheadid . "_" . $feestructure->id;
            $feestructure->update(['foreign_fee_head_id' => $foreign_fee_head_id, 'custom_fee_id' => $foreign_fee_head_id]);
            //custom create instalment id
            $instalmentid = $request["student_" . $studentid . "_instalment_id"] . "_" . $feestructure->id;
            $data2 = [
                'pay_id' => $payid,
                'fee_head_id' => $feeheadid,
                'foreign_fee_head_id' => $foreign_fee_head_id,
                'pay_type' => 'custom',
                'instalment_id' => $instalmentid,
                'instalment_unique_id' => $request["student_" . $studentid . "_instalment_id"],
                'print_name' => $request["student_" . $studentid . "_instalment_print"],
                'start_date' => date("Y-m-d", strtotime($request["student_" . $studentid . "_start_date"])),
                'end_date' => date("Y-m-d", strtotime($request["student_" . $studentid . "_start_date"])),
                'concession_type' => $request["student_" . $studentid . "_concession_type"],
                'concession' => $request["student_" . $studentid . "_concession"],
                'custom_fee_id' => $foreign_fee_head_id,
                'sequence' => $request["student_" . $studentid . "_priority_id"]
            ];
            $feeheadinstalment = FeeHeadInstallment::create($data2);
            if ($feeheadinstalment) {
                $data3 = [
                    'fee_head_structure_id' => $feestructure->id,
                    'fee_head_id' => $feeheadid,
                    'instalment_id' => $instalmentid,
                    'fee_amount' => $request["student_" . $studentid . "_fee_head_amount"]
                ];
                $customefeeinsert = FeeStructureInstalment::create($data3);
                if ($customefeeinsert) {
                    return $foreign_fee_head_id;
                }
            }
        }
        return null;
    }
}
