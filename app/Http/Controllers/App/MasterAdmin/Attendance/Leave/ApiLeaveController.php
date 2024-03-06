<?php

namespace App\Http\Controllers\MasterAdmin\Attendance\Leave;

use App\Helper\FileUpload;
use App\Helper\FileUrl;
use App\Http\Controllers\Controller;
use App\Model\FileStorage;
use App\Model\MasterAdmin\Attendance\LeaveRecord;
use App\Model\MasterAdmin\Attendance\LeaveStatusRecord;
use App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiLeaveController extends Controller
{
    use FileUpload;
    public function apistorestudentleave($studentid,Request $request)
    {
        return $this->apistoreleave($studentid,$request);
    }

    public function apistorestaffleave($userid,$staffid,Request $request)
    {
        $request->merge(['user_role' => 'staff']);
        return $this->apistoreleave($staffid,$request);
    }


    public function apistoreleave($applybyid,$request)
    {

        try {
            $data=[
                'leave_to'=>$request->user_role,
                'leave_type_id'=>$request->leave_type,
                'reason'=>$request->leave_reasons,
                'start_date'=>nowdate($request->from_date,'Y-m-d'),
                'end_date'=>nowdate($request->to_date,'Y-m-d'),
                'total_leave'=>$request->total_leave_days ? $request->total_leave_days : 0
            ];
            if(isset($request->student_id)&&($request->student_id)){
                $data=array_merge($data,['student_id'=>$request->student_id]);
            }

            if(isset($request->staff_id)&&($request->staff_id)){
                $data=array_merge($data,['staff_id'=>$request->staff_id]);
            }


            $leavesave=LeaveRecord::create($data);
            if($leavesave) {
                //if file extension available
                $extension=[];if(isset($request['fileExtension'])){$extension=explode("~",$request['fileExtension']);}
                $documentids=array();
                //leave document uploader
                for ($i=0;$i<=5;$i++){
                    if(isset($request['fileList'.$i.''])){
                        $file=$request['fileList'.$i.''];
                        if($file) {
                            //if file extension available
                            if (isset($extension[$i])) {
                                $FileExtension = $extension[$i];
                            } else {
                                $FileExtension = '.jpg';
                            }
                            //Store File
                            $fileresult = $this->upload($file, ['base64' => true, 'integrate' => 'document', 'db_id' => $leavesave->id, 'extension' => $FileExtension]);
                            $documentids = array_merge($documentids, [$fileresult['file_id']]);
                        }
                    }
                }
                //Leave Document Update file ids
                $leavesave->update(['document_ids'=>implode(",",$documentids)]);
                return response()->json([
                    'result' => 1,
                    'message' => 'record save'
                ], 200);
            }
        }catch (\Exception $e){}
        return response()->json([
            'result' => 0,
            'message' => 'request failed'
        ], 200);
    }
    /*
     * Student Leave Records
     */
    public function apistudentmyleave($userid,$studentid)
    {
        return $this->apileaverecord(['student_id'=>$studentid]);
    }
    //Staff Leave Records
    public function apistaffleave($userid,$staffid)
    {
        return $this->apileaverecord(['staff_id'=>$staffid]);
    }

    /*
     * Leave reports/list
     */

    public function apileavelist($userid,Request $request)
    {
        return $this->apileaverecord($request->all());
    }

    /*
     * leave cancel
     */
    public function apileavecancel($studentid,Request $request)
    {
        $leaverecord=LeaveRecord::find($request->leaveid);
        if($leaverecord) {
            $leavestatus = LeaveStatusRecord::create(['leave_id' => $request->leaveid, 'reason' => $request->reason, 'status' => $request->status]);
            if ($leavestatus) {
                $leaverecord->update(['leave_status'=>$request->status,'leave_status_reason'=>$request->reason,'approve_by_user_id'=>$leavestatus->user_id,'leave_status_updated'=>Carbon::now()]);
                return response()->json([
                    'result' => 1,
                    'message' => 'record save'
                ]);
            }
        }
        return response()->json([
            'result'=>0,
            'message'=>'record save'
        ]);
    }

    /*
     * Leave Master Record
     */
    public function apileaverecord($search)
    {
        $leaverecord=(new StudentAttendanceRepositories())->leaverecordlistdesc($search)->map(function ($data){
            //get submitted by name
            $applicantname="N/A";
            $applicantprofile="";
            try {
                if($data->leave_to=="student"){
                    $applicantname=$data->user ? ucfirst($data->user->student->fullName()) : "N/A";
                    $applicantprofile=$data->user ? $data->user->student->ProfileImage() : "";
                }elseif($data->leave_to=="staff"){
                    $applicantname=$data->user ? ucfirst($data->user->staff->fullName()) : "N/A";
                    $applicantprofile=$data->user ? $data->user->staff->ProfileImage() : "";
                }else{
                    $applicantname=$data->user ? ucfirst($data->user->fullName()) : "N/A";
                    $applicantprofile=$data->user ? $data->user->ProfileImage() : "";
                }
            }catch (\Exception $e){}

            //leave file attachments
            $attachments=[];
            if($data->document_ids){
                $documentidsarray=explode(",",$data->document_ids);
                foreach ($documentidsarray as $document_ids){
                    $filestorage=(new CommanDataRepository())->filestorage($document_ids);
                    if($filestorage) {
                        $attachments[] = ['file_name' => $filestorage->file_name,'file_path' =>FileUrl($filestorage->id),'extension' =>$filestorage->extension];
                    }
                }
            }
            return [
                'lv_id'=>$data->id,
                'apply_date'=>nowdate('','d-M-Y'),
                'lv_from_date'=>nowdate($data->start_date,'d-M-Y'),
                'lv_to_date'=>nowdate($data->end_date,'d-M-Y'),
                'lv_days'=>$data->total_leave,
                'lv_title'=>$data->LeaveTypeName(),
                'lv_description'=>$data->reason,
                'attachment'=>$attachments,
                'lv_status'=>ucfirst($data->leave_status),
                'response_return'=>[],
                'leave_apply_by'=>$applicantname,
                'leave_apply_by_profile'=>$applicantprofile,
            ];
        });

        return response()->json([
            'result'=>1,
            'message'=>'record found',
            'success'=>$leaverecord
        ]);
    }
}
