<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentSearchController extends Controller
{
    public function index($acleaderno,$payuptomonth,$admissionno)
    {
        $payuptomonth=nowdate($payuptomonth,'d-m-Y');
        $search=['admission_no'=>0];
        if($acleaderno){
            $search=['ac_ledger_no'=>$acleaderno];
        }elseif($admissionno){
            $search=['admission_no'=>$admissionno];
        }
        $student=(new StudentRepository())->studentshortlist($search);
        return view('erpmodule.MasterAdmin.Finance.FeeEntry.Page.student-student-list-ui',compact(['student','payuptomonth']));
    }
}
