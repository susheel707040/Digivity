<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\FinanceAssignTransportRequest;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentAvoid;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class FinanceStudentAssignTransportController extends Controller
{
    public function index($studentid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        $feeheadinstalment=collect((new FinanceRepository())->feeheadwithinstalmentlist(['type'=>'transport']))->first();
        return view('erpmodule.MasterAdmin.transport.Entry.finance-student-assign-transport',compact(['student','feeheadinstalment']));
    }

    public function store(StudentRecord $studentrecord,FinanceAssignTransportRequest $request)
    {
        $request->validated();
        $request->merge(['transport_start_date'=>date('Y-m-d',strtotime($request->transport_start_date))]);
        $studentrecord->update($request->all());

        if(isset($request["instalment_id"])){
            StudentFeeHeadInstalmentAvoid::query()->where('student_id',$studentrecord->student_id)->where('foreign_fee_head_id',$request['fee_head_id'])->record()->forceDelete();
        //fee head instalment disable
        $instalment_id=implode(",",$request["instalment_id"]);
            $data=[
                'student_id'=>$studentrecord->student_id,
                'fee_head_id'=>$request['fee_head_id'],
                'foreign_fee_head_id'=>$request['fee_head_id'],
                'instalment_id'=>$instalment_id
        ];
            StudentFeeHeadInstalmentAvoid::create($data);
        }
        return back()->with('success','Transport Assign Successful Complete');
    }

    public function remove($studentid)
    {

    }
}
