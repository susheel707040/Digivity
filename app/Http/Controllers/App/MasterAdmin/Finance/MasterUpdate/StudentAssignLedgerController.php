<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterUpdate;

use App\Http\Controllers\Controller;
use App\Imports\ImportFile;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentAssignLedgerController extends Controller
{
    public function index(Request $request)
    {
            /*
             * Student Import AC Ledger Number Excel File
             */
            $importdata=[];
            if($request->hasFile('import_file')){
                $importdata = collect(Excel::toArray(new ImportFile(), request()->file('import_file')))->shift();
                $importdataarr=[];
                foreach ($importdata as $key=>$data){
                    if($key!=0) {
                        $importdataarr[] = ['admission_no' => $data[0], 'ac_ledger_no' => $data[1]];
                    }
                }
                $importdata=collect($importdataarr);
            }

            /*
             * Student Group List
             */
            $studentgroup=StudentRecord::query()->with(['course','section','student'])->record()->get()->groupBy(function($value) use($request){
            if(isset($request->sibling_group)&&($request->sibling_group=="yes"))
            {
                return $value->id;
            }
            $groupval=[];
            if(isset($request->contact_group)&&($request->contact_group=="yes")){
                $groupval[]=$value->student->contact_no;
            }

            if(isset($request->father_group)&&($request->father_group=="yes")){
                $groupval[]=$value->student->father_name;
            }
            if(isset($request->mother_group)&&($request->mother_group=="yes")){
                $groupval[]=$value->student->mother_name;
            }
            return implode("@",$groupval);
        });
        return view('app.erpmodule.MasterAdmin.Finance.MasterUpdate.student-assign-ledger',compact(['studentgroup','importdata']));
    }

    public function store(Request $request)
    {
        if(count($request->student_id)){

            foreach ($request->student_id as $studentid){
                $student=StudentRecord::find($studentid);
                $student->update(['ac_ledger_no'=>$request["student_".$studentid."_ac_ledger"]]);
            }
            return back()->with('success','Record Save Successful Complete');
        }else{
            return back()->with('danger','Please , Select atleast one student');
        }
    }

}
