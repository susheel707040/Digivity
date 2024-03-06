<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class AddStudentConcessionController extends Controller
{
    public function index($studentid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.add-student-concession-type',compact(['studentid','student']));
    }

    public function store(StudentRecord $studentrecord,Request $request)
    {
        $studentrecord->update($request->all());
        return back()->with('success','Student Concession Apply Successful Complete');
    }

    public function removeconcession(StudentRecord $studentrecord)
    {
        $studentrecord->update(['fee_concession_id'=>0]);
        return back()->with('success','Student Concession Remove Successful Complete');
    }
}
