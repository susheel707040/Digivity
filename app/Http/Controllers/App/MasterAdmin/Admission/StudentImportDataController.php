<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Exports\ExportExcelFile;
use App\Helper\DateFormat;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\MasterAdmin\Admission\StudentAdmission;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Transport\MasterSetting\Route;
use App\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class StudentImportDataController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.import-student-data');
    }

    public function indexview(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $importdata = collect(Excel::toArray(new StudentImport(), request()->file('import_file')))->shift();
            $tablehead = $importdata[0];
            return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.import-student-data-view', compact(['tablehead', 'importdata']));
        } else {
            return back()->with('danger', 'Please choose import file');
        }
    }

    public function importstudentstore(Request $request)
    {
        // return $request;
        $insert=0;
        foreach ($request["slno"] as $slno) {
            $data=$request["input_".$slno."_id"];

            if(isset($data['admission_date'])){
            $data['admission_date']=DateFormat::UnixDate($data['admission_date']);
            }else{
                Log::error('Admission date is not set for student record. Student ID: ');

            }
            if(isset($data['transport_start_date'])){
            $data['transport_start_date']=DateFormat::UnixDate($data['transport_start_date']);
            }else{
                Log::error('Transport Start date is not set for student record. Transpoer Date: ');

            }
            $data['transport_status']="active";
        //     if(isset($data['dob'])){
        //     $data['dob']=DateFormat::UnixDate($data['dob']);

        // }else{
        //     Log::error('Date of birth is not set for student record. Date of Birth: ');

        // }

        $student = StudentRecord::create($data);
        if (!$student || !$student->id) {
            return back()->with('danger', 'Sorry, Request failed, Please try again.');
        }


            //save student personal details
            $studentrecord = StudentAdmission::create($data);
            if (!$studentrecord->id) {
                $data['student_id'] = $studentrecord->id;



                //get role get for student login
                $role = Role::query()->where('alias', 'student')->first();

                //create new request parameters for user table
                $username = Str::lower($studentrecord->first_name . $studentrecord->id);
                $pwd = Str::lower($studentrecord->first_name . $studentrecord->id);
                $data = array_merge($data, ['role_id' => $role->id, 'username' => $username, 'password' => Hash::make($pwd), 'pwd' => $pwd]);

                //user administration create
                $userregistration = User::create($data);
                $userregistration->roles()->attach($role->id);
                $data['ac_user_id'] = $userregistration->id;

                //student admission class wise
                StudentRecord::create($data);
                $insert++;
            }
            $student->student_id = $studentrecord->id;
            $student->save();
            }
        if($insert){
            return redirect('MasterAdmin/StudentInformation/ClassWiseStudentList')->with('success','Student Record Import Successfully');
        }else{
            return redirect('MasterAdmin/StudentInformation/ImportStudentData')->with('success','Student Record Import Successfully');
        }
    }
}
