<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentBulkUpdateController extends Controller
{
    public function index(Request $request)
    {
        $importdataarr=[];
        if ($request->hasFile('import_file')) {
            $importdata = collect(Excel::toArray(new StudentImport(), request()->file('import_file')))->shift();
            $tablehead=$importdata[0];

            foreach ($importdata as $key=>$data){
                if($key!=0) {
                    $dataarr=[];
                    foreach ($data as $key1=>$data1){
                        $dataarr[$tablehead[$key1]] = $data1;
                        // $dataarr=array_merge($dataarr,[$tablehead[$key1]=>$data[$key1]]);
                    }
                    $importdataarr[] = $dataarr;
                    // $importdataarr[]=array_merge($importdataarr,$dataarr);
                   }
            }
        }

        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.student-bulk-update',compact(['student','importdataarr']));
    }

    public function modify(Request $request)
    {
        if(isset($request->studentid)&&($request->studentid)){
            foreach ($request->studentid as $studentid){
                $studentupdate=[];
                if(isset($request["fieldid_$studentid"])){
                    foreach ($request["fieldid_$studentid"] as $fieldid){
                        $studentupdate=array_merge($studentupdate,[$fieldid=>$request[$fieldid."_".$studentid]]);
                    }
                }
                try {
                    $student=StudentRecord::query()->with(['student'])->where(['student_id'=>$studentid])->record()->first();
                    $student->update($studentupdate);
                    $student->student->update($studentupdate);
                }catch (\Exception $e){}
            }
            return back()->with('success','Record Update Successful Complete.');
        }
        return back()->with('danger','Please select atleast one student.');
    }


}
