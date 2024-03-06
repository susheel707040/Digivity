<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff;

use App\Helper\FormNoGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\StaffRecordRequest;
use App\Models\MasterAdmin\Staff\StaffRecord;
use App\Models\MasterAdmin\Staff\StaffRecordDocument;
use App\Models\MasterAdmin\Staff\StaffRecordQualification;
use App\Models\MasterAdmin\Staff\StaffRecordSkillKnowledge;
use App\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StaffRecordController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Staff.Entry.staff-registration');
    }

    public function store(StaffRecordRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $data['joining_date']=nowdate($request->joining_date,'Y-m-d');
        $request->date_of_retire ? $data['date_of_retire']=nowdate($request->date_of_retire,'Y-m-d') : $data['date_of_retire']=null;
        $request->date_of_extend ? $data['date_of_extend']=nowdate($request->date_of_extend,'Y-m-d') : $data['date_of_extend']=null;
        $request->dob ? $data['dob']=nowdate($request->dob,'Y-m-d') : $data['dob']=null;
        $request->dob ? $data['doa']=nowdate($request->doa,'Y-m-d') : $data['dob']=null;

        /**
         * Employee No get auto fill
         */
        if (FormNoGenerate::generate('staff_no')) {
            $getstaffnno = FormNoGenerate::generate('staff_no');
            if ($getstaffnno->should_be == "auto") {
                $data = array_merge($data, ['staff_no' => $getstaffnno->GetNo()]);
            }
        }

         // Save image if provided
    if ($request->hasFile('profile_img')) {

        $StaffprofileImage = $request->file('profile_img');

        $StaffProfileImageName = $StaffprofileImage->getClientOriginalName();

        $StaffprofileImage->move(public_path('uploads/staff_profile_image'), $StaffProfileImageName);

        $data['profile_img'] = $StaffProfileImageName;
    }

        $staff = StaffRecord::create($data);

        if (!$staff) {
        $username=Str::lower($staff->first_name.$staff->id);
        $psw=Str::lower($staff->first_name.$staff->id);

        $role = Role::query()->where('alias', 'teacher')->first();
        $data = array_merge($data, ['role_id' => $role->id,'staff_id' => $staff->id, 'username' => $username, 'password' => Hash::make($psw)]);
        $userregistration = User::create($data);
        $userregistration->roles()->attach($role->id);
        $staff->update(['ac_user_id'=>$userregistration->id,'username'=>$username,'psw'=>$psw]);

        /*
         * Qualification Insert
         */
        if(isset($request->qualification)&&(count($request->qualification))){
            foreach ($request->qualification as $qualificationid) {
                if ($qualificationid) {
                    StaffRecordQualification::create(['staff_id' => $staff->id, 'qualification_id' => $qualificationid]);
                }
            }
        }

        /*
         * Skill and Knowledge Insert
         */
        if(isset($request->skill_knowledge_id)&&(count($request->skill_knowledge_id))){
            foreach ($request->skill_knowledge_id as $skill_knowledge_id){
                if($skill_knowledge_id){
                    StaffRecordSkillKnowledge::create(['staff_id' => $staff->id, 'skill_knowledge_id' => $skill_knowledge_id]);
                }
            }
        }

        /*
         * Document Insert
         */
        if(isset($request->document_id)&&(count($request->document_id))){
            foreach ($request->document_id as $key=>$docuemntid){
                if($docuemntid){
                    isset($request->document_name[$key])? $documentname=$request->document_name[$key] : $documentname=null;
                    $extension="";
                    $document_file="";
                    StaffRecordDocument::create(['staff_id' => $staff->id,'document_id'=>$docuemntid,'document_name'=>$documentname,'extension'=>$extension,'document_file'=>$document_file]);
                }
            }
        }

        /*
         * Staff Number increment 1
         */
        if(isset($getstaffnno)){
            $getstaffnno->increment('start_from',1);
        }
    }
        return back()->with('success', 'Staff Record Create Successfully');


}

    public function editview(StaffRecord $staffrecord)
    {
        return view('app.erpmodule.MasterAdmin.Staff.Entry.Edit.edit-staff-registration',compact(['staffrecord']));
    }

    public function modify(StaffRecord $staffrecord, StaffRecordRequest $request)
    {
        $data = $request->validated();
        $data['joining_date']=nowdate($request->joining_date,'Y-m-d');
        $request->date_of_retire ? $data['date_of_retire']=nowdate($request->date_of_retire,'Y-m-d') : $data['date_of_retire']=null;
        $request->date_of_extend ? $data['date_of_extend']=nowdate($request->date_of_extend,'Y-m-d') : $data['date_of_extend']=null;
        $request->dob ? $data['dob']=nowdate($request->dob,'Y-m-d') : $data['dob']=null;
        $request->dob ? $data['doa']=nowdate($request->doa,'Y-m-d') : $data['dob']=null;

        if ($request->hasFile('profile_img')) {
            $StaffUpdateprofileImage = $request->file('profile_img');
            $StafffileName = $StaffUpdateprofileImage->getClientOriginalName();
            // Move the file to the desired location
            $StaffUpdateprofileImage->move(public_path('uploads/staff_image'), $StafffileName);
            // Update the data array with the file name
            $data['profile_img'] = $StafffileName;

            // Delete old image if it exists
            if ($staffrecord->profile_img) {
                $oldStaffImagePath = public_path('uploads/staff_image/' . $staffrecord->profile_img);
                if (file_exists($oldStaffImagePath)) {
                    unlink($oldStaffImagePath);
                }
            }
        }

        $staffrecord->update($data);
        return back()->with('success', 'Record Update Successfully done');
    }

    /*
     * Mobile Application Controller
     */
    public function apiindex()
    {
        $professiontype = [];
        $stafftype = [];
        $department = [];
        $designation = [];
        $maritalstatusarr = [];
        $titlelist=[];
        try {
            foreach (professtiontypelist([]) as $data){
                $professiontype[]=['id'=>$data->id,'value'=>$data->profession_type];
            }
            foreach (stafftypelist([]) as $data){
                $stafftype[]=['id'=>$data->id,'value'=>$data->staff_type];
            }
            foreach (staffdepartmentlist([]) as $data){
                $department[]=['id'=>$data->id,'value'=>$data->department];
            }
            foreach (satffdesignationlist([]) as $data){
                $designation[]=['id'=>$data->id,'value'=>$data->designation];
            }
            foreach (maritalstatus() as $data){
                $maritalstatusarr[]=['id'=>$data,'value'=>ucfirst($data)];
            }
            $title_name = array('mr.', 'ms.', 'mrs.', 'miss.', 'dr.', 'fr.', 'sr.');
            foreach ($title_name as $value){
                $titlelist[]=['id'=>$value,'value'=>$value];
            }
        }catch (\Exception $e){}
        return response()->json([
            'result' => 1,
            'success' => [
                [
                    'professiontype' => $professiontype,
                    'stafftype' => $stafftype,
                    'department' => $department,
                    'designation' => $designation,
                    'maritalstatus' => $maritalstatusarr,
                    'title'=>$titlelist
                ]
            ]
        ],200);
    }


    public function apiaddstaff()
    {
        return response()->json([
            'result'=>1,
            'message'=>'Staff Record Update Successfully Complete',
            'success'=>null
        ],200);

    }

}
