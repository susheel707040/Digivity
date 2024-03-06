<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentIDCardController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.IDCard.student-id-card');
    }

    public function indexsearch(Request $request)
    {
        $search=['search'=>$request->all()];
        //admission date search between
        if(($request->adm_from_date)&&($request->adm_to_date)){
            $search['customsearch']=['whereBetween'=>['admission_date'=>[nowdate($request->adm_from_date,'Y-m-d'),nowdate($request->adm_to_date,'Y-m-d')]]];
        }
       // dd($search);
        $student=(new StudentRepository())->studentshortlist($search);
        return view('app.erpmodule.MasterAdmin.StudentInformation.IDCard.student-id-card',compact('student'));
    }

    public function idcardprint($idcardtemplate,$selectuser,$selectuserids)
    {
        $userdata = [];
        if($selectuser=="student"){
            $studentids=explode(",",$selectuserids);
            if(isset($studentids)&&(is_array($studentids))&&(count($studentids)>1)) {
                $userdata = (new StudentRepository())->studentshortlist(['customsearch' => ['whereIn' => ['student_id' => $studentids]]]);
            }
        }
        return view('app.erpmodule.MasterAdmin.IDCard.id-card-print',compact(['userdata']));
    }
}
