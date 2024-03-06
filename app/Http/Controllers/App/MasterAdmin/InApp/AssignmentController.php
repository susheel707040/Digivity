<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\AssignmentRequest;
use App\Models\MasterAdmin\InApp\Assignment;
use App\Models\MasterAdmin\InApp\AssignmentAttachmentFile;
use App\Models\MasterAdmin\InApp\NoticeAttachmentFile;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    use FileUpload;

    public function index()
    {
        $assignment = (new InAppDataRepository())->assignmentlist([]);
        return view('app.erpmodule.MasterAdmin.InApp.Assignment.define-assignment', compact(['assignment']));
    }

    public function store(AssignmentRequest $request)
    {
        $request->validated();
        $request->merge(['assignment_date' => Carbon::createFromDate($request->assignment_date)->format('Y-m-d')]);
        $request->merge(['assigned_date' => Carbon::createFromDate($request->assigned_date)->format('Y-m-d')]);
        $request->merge(['submitted_date' => Carbon::createFromDate($request->submitted_date)->format('Y-m-d')]);

        $assignment = Assignment::create($request->all());
        if ($assignment) {
            if ($request->file_url) {
                foreach ($request->file_url as $key => $value) {
                    $data = [
                        'assignment_id' => $assignment->id,
                        'file_name' => $request['file_name'][$key],
                        'file_path' => $value,
                        'extension' => '',
                        'user_id' => $assignment->user_id
                    ];
                    AssignmentAttachmentFile::create($data);
                }
            }
            return back()->with('success', 'Assignment Record Save Successful Complete');
        } else {
            return back()->with('danger', 'Sorry, Request failed, please try again');
        }

    }

    public function editview(Assignment $assignment)
    {
        return view('app.erpmodule.MasterAdmin.InApp.Assignment.Edit.edit-assignment', compact(['assignment']));
    }

    public function modify(Assignment $assignment, AssignmentRequest $request)
    {
        $request->validated();
        $request->merge(['assignment_date' => Carbon::createFromDate($request->assignment_date)->format('Y-m-d')]);
        $request->merge(['assigned_date' => Carbon::createFromDate($request->assigned_date)->format('Y-m-d')]);
        $request->merge(['submitted_date' => Carbon::createFromDate($request->submitted_date)->format('Y-m-d')]);

        $assignment->update($request->all());
        if ($request->file_url) {
            foreach ($request->file_url as $key => $value) {
                $data = [
                    'notice_id' => $assignment->id,
                    'file_name' => $request['file_name'][$key],
                    'file_path' => $value,
                    'extension' => '',
                    'user_id' => $assignment->user_id
                ];
                NoticeAttachmentFile::create($data);
            }
        }
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/App/EditViewAssignment/' . $assignment->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');

    }


    /*
     * Mobile Api Post Create
     */

    public function apistore(Request $request)
    {
        $data = $request->all();
        if (isset($data['course_id']) && (isset($data['assignment_date']))) {
            //courseid@section convert to array
            $course = explode("@", $data['course_id']);
            $course_id = $course[0];
            $section_id = $course[1];

            $datainsert = [
                'type' => $data['type'],
                'course_id' => $course_id,
                'section_id' => $section_id,
                'student_id' => $data['student_id'],
                'subject_id' => $data['subject_id'],
                'staff_id' => $data['staff_id'],
                'assignment_date' => $data['assignment_date'],
                'assigned_date' => $data['assigned_date'],
                'submitted_date' => $data['submitted_date'],
                'assignment_title' => $data['assignment_title'],
                'assignment' => $data['assignment'],
                'show_date_time' => $data['show_date_time'],
                'end_date_time' => $data['end_date_time'],
                'with_app' => $data['with_app'],
                'with_text_sms' => $data['with_text_sms'],
                'with_email' => $data['with_email'],
                'with_website' => $data['with_website'],
                'status' => $data['status'],
            ];
            /*
             * Insert Assignment Data
             */
            $assignemnt=Assignment::create($datainsert);
            if($assignemnt){
            //if file extension available
            $extension=[];if(isset($data['fileExtension'])){$extension=explode("~",$data['fileExtension']);}
            //assigment document uploader
                for ($i=0;$i<=5;$i++){
                    if(isset($data['fileList'.$i.''])) {
                        $file = $data['fileList'.$i.''];
                        //if file extension available
                        $extension[$i] ? $FileExtension=$extension[$i] : $FileExtension=null;
                        //Store File
                        $fileresult=$this->upload($file,['base64'=>true,'integrate'=>'assignment','db_id'=>$assignemnt->id,'extension'=>$FileExtension]);

                        AssignmentAttachmentFile::create(['assignment_id'=>$assignemnt->id,'file_name'=>$fileresult['file_name'],'file_path'=>$fileresult['file_id'],'extension'=>$fileresult['file_extension'],'user_id'=>$data['user_id']]);
                    }
                }
                return response()->json([
                    'result' => 1,
                    'message' => 'record found'
                ], 200);
            }
            return response()->json([
                'result' => 0,
                'message' => 'request failed'
            ], 200);
        }
    }
    /*
     * Master Admin and Teacher Assignment Report
     */
    public function apiassignmentreport(Request $request)
    {
        //Create Search
        $search=$request->all();
        if(isset($request->course_id)&&($request->course_id)){
            $course=explode("@",$request->course_id);
            $search=array_merge($search,['course_id'=>$course[0],'section_id'=>$course[1]]);
        }
        return $this->apiassignmentrecord($search);
    }
    /*
     * Student Assignment Report
     */
    public function apistudentassignmentreport($studentid,$subjectid)
    {
        $search=['subject_id'=>$subjectid];
        $student=(new StudentRepository())->studentshortlist(['student_id'=>$studentid])->first();
        if($student){
            $search=array_merge($search,['course_id'=>$student->course_id,'section_id'=>$student->section_id]);
        }
        return $this->apiassignmentrecord($search);
    }

    //api Master Assignment Record
    public function apiassignmentrecord($search)
    {
        $assignemntdata=[];
        $assignment=(new InAppDataRepository())->assignmentlist($search);
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

                $assignemntdata[]=[
                    'assignment_id'=>$data->id,
                    'type'=>$data->type,
                    'course'=>$data->CourseSection(),
                    'student'=>$data->StudentName(),
                    'subject'=>$data->SubjectName(),
                    'submit_staff'=>$data->StaffName(),
                    'assignment_date'=>nowdate($data->assignment_date,'d-M-Y'),
                    'assigned_date'=>nowdate($data->assigned_date,'d-M-Y'),
                    'submitted_date'=>nowdate($data->submitted_date,'d-M-Y'),
                    'assignment_title'=>$data->assignment_title,
                    'assignment'=>$data->assignment,
                    'show_date_time'=>$data->show_date_time,
                    'end_date_time'=>$data->end_date_time,
                    'with_app'=>$data->with_app,
                    'with_text_sms'=>$data->with_text_sms,
                    'with_email'=>$data->with_email,
                    'with_website'=>$data->with_website,
                    'status'=>$data->status,
                    'submitted_by'=>$data->user ? $data->user->fullName() : "N/A",
                    'submitted_by_profile'=>$data->user ? $data->user->ProfileImage() : null,
                    'attachment'=>$attachmentfile,
                ];
            }
            return response()->json([
                'result' => 1,
                'message' => 'record found',
                'success'=>$assignemntdata
            ], 200);
        }
        return response()->json([
            'result' => 0,
            'message' => 'request failed'
        ], 200);
    }


    //remove assignment
    public function apiremove($userid,Assignment $assignment)
    {
        $assignment->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Assignment Remove Successful Complete',
            'success' => null
        ]);
    }

}
