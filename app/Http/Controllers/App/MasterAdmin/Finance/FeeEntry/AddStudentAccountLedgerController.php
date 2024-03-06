<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class AddStudentAccountLedgerController extends Controller
{
    public function index($studentid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.add-student-account-ledger',compact(['student']));
    }

    public function store(StudentRecord $studentrecord,Request $request)
    {
        $studentrecord->update($request->all());
        return back()->with('success','Student Account Ledger Number Apply Successful Complete');
    }

    public function removeledgerno(StudentRecord $studentrecord)
    {
        $studentrecord->update(['ac_ledger_no'=>null]);
        return back()->with('success','Student Account Ledger Number Remove Successful Complete');
    }
}
