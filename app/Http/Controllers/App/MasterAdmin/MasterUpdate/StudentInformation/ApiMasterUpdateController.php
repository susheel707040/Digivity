<?php

namespace App\Http\Controllers\MasterAdmin\MasterUpdate\StudentInformation;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiMasterUpdateController extends Controller
{
    //student rollnumber update
    public function apirollnoupdate($userid,Request $request)
    {
        try {
            if(isset($request->updatedatalist)){
                foreach ($request->updatedatalist as $studentdata){
                    $student=StudentRecord::query()->where(['student_id'=>$studentdata['student_id']])->record()->first();
                    $student->update(['roll_no'=>$studentdata['roll_no']]);
                }
            }
            return response()->json(1,200);
        }catch (\Exception $e){}
        return response()->json(0,200);
    }

}
