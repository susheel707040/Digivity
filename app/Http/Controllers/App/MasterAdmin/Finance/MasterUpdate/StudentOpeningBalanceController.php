<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterUpdate;

use App\Http\Controllers\Controller;
use App\Imports\ImportFile;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeStructureInstalment;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentOpeningBalanceController extends Controller
{
    public function index(Request $request)
    {
        $importdata=[];
        if($request->hasFile('import_file')){
            $importdata = collect(Excel::toArray(new ImportFile(), request()->file('import_file')))->shift();
            $importdataarr=[];
            foreach ($importdata as $key=>$data){
                if($key!=0) {
                    $importdataarr[] = ['admission_no' => ''.$data[0].'', 'opening_balance' => ''.$data[1].''];
                }
            }
            $importdata=collect($importdataarr);
        }
        $student=(new StudentRepository())->studentshortlist([]);
        return view('app.erpmodule.MasterAdmin.Finance.MasterUpdate.student-opening-balance-entry',compact(['student','importdata']));
    }

    public function store(Request $request)
    {
        // if(count($request->student_id)){
            if (!empty($request->student_id) && is_array($request->student_id)) {


            $result=0;
            foreach ($request->student_id as $studentid) {
                if (!empty($request["student_" . $studentid . "_fee_amount"])) {
                    $feeheadid = $request["student_" . $studentid . "_fee_head_id"];
                    $data1 = [
                        'fee_to' => 'student',
                        'fee_group_id' => null,
                        'student_id' => $studentid,
                        'fee_head_id' => $feeheadid,
                        'foreign_fee_head_id' => $feeheadid,
                        'fee_amount' => $request["student_" . $studentid . "_fee_amount"],
                        'custom_fee_id' => null,
                        'custom_fee_pay_status' => null
                    ];
                    $feestructure = FeeStructure::create($data1);
                    $data3 = [
                        'fee_head_structure_id' => $feestructure->id,
                        'fee_head_id' => $feeheadid,
                        'instalment_id' => $request["student_" . $studentid . "_fee_instalment"],
                        'fee_amount' => $request["student_" . $studentid . "_fee_amount"]
                    ];
                    $feestructureinstalment = FeeStructureInstalment::create($data3);
                    if (($feestructureinstalment) && ($feestructure)) {
                        $result += 1;
                    } else {
                        $feestructure->delete();
                    }
                }
            }
            if ($result != 0) {
                return back()->with('success', 'Record Save Successful Complete');
            }
            return back()->with('danger','Sorry, Request failed, Please try again.');
        }
        return back()->with('danger','Please select atleast one student');
    }
}
