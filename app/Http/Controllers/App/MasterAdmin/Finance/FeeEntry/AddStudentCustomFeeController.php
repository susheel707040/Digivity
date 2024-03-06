<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterAdmin\Finance\Helper\CustomFeeStore;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeHeadInstallment;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeStructure;
use App\Model\MasterAdmin\Finance\FeeSetting\FeeStructureInstalment;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class AddStudentCustomFeeController extends Controller
{
    public function index($studentid)
    {
        $student = collect(studentshortlist(['student_id' => $studentid]))->shift();
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.QuickAction.add-student-custom-fee', compact(['studentid', 'student']));
    }

    public function store($studentid, Request $request)
    {
        /**
         * custom fee create function
         */
        CustomFeeStore::storefee($studentid,$payid=null,$request);
        return back()->with('success','Student Custom Fee Add Successful Complete');
    }
}
