<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff;

use App\Http\Controllers\Controller;
use App\Helper\FormNoGenerate;
use App\Helper\DateFormat;
use Illuminate\Http\Request;
use App\Imports\StaffImport;
use App\Models\MasterAdmin\Staff\StaffRecord;
use Illuminate\Support\Str;
use App\Role;
use App\Models\User;
use App\Models\MasterAdmin\Staff\StaffRecordQualification;
use App\Models\MasterAdmin\Staff\StaffRecordDocument;
use App\Models\MasterAdmin\Staff\StaffRecordSkillKnowledge;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StaffImportController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Staff.Entry.staff-import-data');
    }
    public function staffindexview(Request $request){
        if($request->hasfile('import_file')){
            $importdata = collect(Excel::toArray(new StaffImport(),request()->file('import_file')))->shift();
            $tablehead = $importdata[0];
            return view('app.erpmodule.MasterAdmin.Staff.Entry.staff-import-view',compact(['tablehead','importdata']));
        }
        else{
            return back()->with('danger','Please choose import file');
        }
    }
    public function importstaffstore(Request $request){
        // return $request;

        $insert=0;
        foreach($request["slno"] as $slno){
            $data=$request["input_".$slno."_id"];

            $data['joining_date']=DateFormat::UnixDate($data['joining_date']);
            $data['date_of_retire']=DateFormat::UnixDate($data['date_of_retire']);
            $data['date_of_extend']=DateFormat::UnixDate($data['date_of_extend']);
            $data['dob']=DateFormat::UnixDate($data['dob']);
            $data['doa']=DateFormat::UnixDate($data['doa']);

            if (FormNoGenerate::generate('staff_no')) {
                $getstaffnno = FormNoGenerate::generate('staff_no');
                if ($getstaffnno->should_be == "auto") {
                    $data = array_merge($data, ['staff_no' => $getstaffnno->GetNo()]);
                }
            }

            $staffrecord = StaffRecord::create($data);
            if($staffrecord->id) {
                $username=Str::lower($staffrecord->first_name.$staffrecord->id);
                $psw=Str::lower($staffrecord->first_name.$staffrecord->id);

                // $role = Role::query()->where('alias', 'teacher')->first();
                // $data = array_merge($data, ['role_id' => $role->id,'staff_id' => $staffrecord->id, 'username' => $username, 'password' => Hash::make($psw)]);
                // $userregistration = User::create($data);
                // $userregistration->roles()->attach($role->id);
                // $staffrecord->update(['ac_user_id'=>$userregistration->id,'username'=>$username,'psw'=>$psw]);
        
                if(isset($request->qualification)&&(count($request->qualification))){
                    foreach ($request->qualification as $qualificationid) {
                        if ($qualificationid) {
                            StaffRecordQualification::create(['staff_id' => $staffrecord->id, 'qualification_id' => $qualificationid]);
                        }
                    }
                }
                if(isset($request->skill_knowledge_id)&&(count($request->skill_knowledge_id))){
                    foreach ($request->skill_knowledge_id as $skill_knowledge_id){
                        if($skill_knowledge_id){
                            StaffRecordSkillKnowledge::create(['staff_id' => $staffrecord->id, 'skill_knowledge_id' => $skill_knowledge_id]);
                        }
                    }
                }
                if(isset($request->document_id)&&(count($request->document_id))){
                    foreach ($request->document_id as $key=>$docuemntid){
                        if($docuemntid){
                            isset($request->document_name[$key])? $documentname=$request->document_name[$key] : $documentname=null;
                            $extension="";
                            $document_file="";
                            StaffRecordDocument::create(['staff_id' => $staffrecord->id,'document_id'=>$docuemntid,'document_name'=>$documentname,'extension'=>$extension,'document_file'=>$document_file]);
                        }
                    }
                }
                if(isset($getstaffnno)){
                    $getstaffnno->increment('start_from',1);
                }
            }
        }
            return redirect()->route('staff.import')->with('success', 'Staff Record Create Successfully');
            }
        }
