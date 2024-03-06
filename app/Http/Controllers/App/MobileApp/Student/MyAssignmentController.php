<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\InApp\Assignment;
use Illuminate\Http\Request;

class MyAssignmentController extends Controller
{
    public function report($studentid,$subjectid)
    {
        $assignmentdata=[];
        $assignment=Assignment::query()->with(['subject','attachment','user'])->record()->get();
        if($assignment){
            foreach ($assignment as $data){

                //if assignment attachment
                $attachmentfile = [];
                try {
                    foreach ($data->attachment as $data1) {
                        $attachmentfile[] = ['file_name' => $data1->file_name, 'file_path' => FileUrl($data1->file_path), 'extension' => $data1->extension];
                    }
                } catch (\Exception $e) {
                }

                $assignmentdata[]=[
                    'assignment_id'=>$data->id,
                    'subject'=>$data->SubjectName(),
                    'assignment_title'=>$data->assignment_title,
                    'assignment_details'=>$data->assignment,
                    'assigned_date'=>nowdate($data->assigned_date,'d F, Y'),
                    'submitted_date'=>nowdate($data->submitted_date,'d F, Y'),
                    'submit_to'=>'Ankit Singh',
                    'updated_on'=>nowdate($data->assignment_date,'d F, Y'),
                    'attachment'=>$attachmentfile,
                    'submitted_by'=>$data->user->fullName(),
                    'submitted_by_profile'=>$data->user->ProfileImage(),
            ];
            }
            return response()->json([
                'result'=>1,
                'message'=>'data found',
                'success'=>$assignmentdata
            ],200);
        }else{
            return response()->json([
               'result'=>0,
               'message'=>'data no found',
               'success'=>null
            ],400);
        }
    }
}
