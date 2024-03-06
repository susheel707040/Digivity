<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;

class StudentAccountController extends Controller
{
    public function index(StudentRecord $studentrecord,$status,Request  $request)
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.student-account-status',compact(['studentrecord','status']));
    }

    public function statusupdate(StudentRecord $studentrecord,Request $request)
    {

        $data=$request->all();
        try {
            $inactive_date=null;
            if(isset($request->inactive_date)) {$inactive_date=nowdate($request->inactive_date, 'Y-m-d');}
            $data = array_merge($data, ['inactive_date' =>$inactive_date]);
            $studentrecord->update($data);

            if(request()->ajax()){
                return response()->json([
                    'result'=>1,
                    'status'=>'success',
                    'studentid'=>$studentrecord->id,
                    'message'=>'Student Status Update Successful Complete'
                ],200);
            }
            return back()->with('success','Student Status Update Successful Complete');
        }catch (\Exception $e){
            if(request()->ajax()){
                return response()->json([
                    'result'=>1,
                    'status'=>'success',
                    'studentid'=>$studentrecord->id,
                    'message'=>'Sorry, do not permission to create this record'
                ],200);
            }
            return back()->with('danger','Sorry, do not permission to create this record');
        }
    }
}
