<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionTransferController extends Controller
{
    public function index(Request $request)
    {
        
        if(count($request->all())>0) {
            $student = (new StudentRepository())->studentshortlist($request->all());
        }
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.session-transfer');

       
    }

    public function create($module,Request $request)
    {
        if($module=="student"){
            return $this->studentsessiontransfer($request);
        }
    }

    public function studentsessiontransfer($request)
    {
       //dd($request->all());
        if(count($request->student_db_id)>0&&($request->next_academic_id)&&($request->next_financial_id)){
            //students
           foreach ($request->student_db_id as $id){
               $student=StudentRecord::find($id);
               if($student){
                   //validate student parameters
                   if(($request['course_id_'.$id.''])&&($request['section_id_'.$id.''])&&($request['is_new_'.$id.''])&&($request['status_'.$id.''])){
                       //check student data already exist
                       $studentexist=StudentRecord::query()->where(['academic_id'=>$request->next_academic_id,'financial_id'=>$request->next_financial_id,'student_id'=>$student->student_id])->exists();
                       if(!$studentexist){
                           $copy = $student->replicate()->fill(
                               [
                                   'academic_id'=> $request['next_academic_id'],
                                   'financial_id'=>$request['next_financial_id'],
                                   'course_id'=>$request['course_id_'.$id.''],
                                   'section_id'=>$request['section_id_'.$id.''],
                                   'is_new'=>$request['is_new_'.$id.''],
                                   'status'=>$request['status_'.$id.'']
                               ]
                           );
                           $copydata=$copy->toArray();
                           $copydata=array_merge($copydata,['created_at'=>Carbon::now()->toDateTimeString(),'updated_at'=>Carbon::now()->toDateTimeString()]);
                           $insert=DB::table('student_admission_class_record')->insert($copydata);
                       }
                   }
               }
           }
            return back()->with('success','Student Record Transfer Successful.');
        }
        return back()->with('danger','Please choose atleast one student');
    }
}
