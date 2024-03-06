<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\HomeworkRequest;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\InApp\Homework;
use App\Models\MasterAdmin\InApp\HomeworkAttachmentFile;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
    use FileUpload;

    public function index(Request $request)
    {
        $homework = (new InAppDataRepository())->homeworklist(['hw_date' => nowdate($request->hw_date, 'Y-m-d')]);
        return view('app.erpmodule.MasterAdmin.InApp.Homework.define-homework', compact(['homework']));
    }

    public function store(HomeworkRequest $request)
    {
        $request->validated();
        $request->merge(['hw_date' => Carbon::createFromDate($request->hw_date)->format('Y-m-d')]);
        $homework = Homework::create($request->all());
        if ($homework) {
            if ($request->file_url) {
                foreach ($request->file_url as $key => $value) {
                    $data = [
                        'homework_id' => $homework->id,
                        'file_name' => $request['file_name'][$key],
                        'attachment_files' => $value,
                        'user_id' => $homework->user_id
                    ];
                    HomeworkAttachmentFile::create($data);
                }
            }
            return back()->withInput()->with('success', 'Homework Upload Successful Complete');
        } else {
            return back(compare(['request']))->with('danger', 'Sorry, Request failed, please try again');
        }

    }

    public function editview(Homework $homework)
    {
        return view('app.erpmodule.MasterAdmin.InApp.Homework.Edit.edit-homework', compact(['homework']));
    }

    public function modify(Homework $homework, HomeworkRequest $request)
    {
        $request->validated();
        $request->merge(['hw_date' => Carbon::createFromDate($request->hw_date)->format('Y-m-d')]);
        $homework->update($request->all());
        if ($request->file_url) {
            foreach ($request->file_url as $key => $value) {
                $data = [
                    'homework_id' => $homework->id,
                    'file_name' => $request['file_name'][$key],
                    'attachment_files' => $value,
                    'user_id' => $homework->user_id
                ];
                HomeworkAttachmentFile::create($data);
            }
        }
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/App/EditViewHomework/' . $homework->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }




    /*
     * mobile application api controller
     */

    public function apistore(Request $request)
    {
        $data = $request->all();
        if (isset($data['course_id']) && (isset($data['hw_date']))) {
            //courseid@section convert to array
            $course = explode("@", $data['course_id']);
            $course_id = $course[0];
            $section_id = $course[1];

            //create array for insert homework
            $datainsert = [
               'course_id' =>$course_id,
               'section_id' =>$section_id,
               'subject_id' =>$data['subject_id'],
               'hw_date' =>$data['hw_date'],
               'hw_title' =>$data['hw_title'],
               'homework' =>$data['homework'],
               'with_app' =>$data['with_app'],
               'with_text_sms' =>$data['with_text_sms'],
               'with_email' =>$data['with_email'],
               'with_website' =>$data['with_email'],
               'status' =>$data['status'],
           ];

          /*
           * Create Homework
           */
          $homework=Homework::create($datainsert);

          if($homework){
              //if file extension available
              $extension=[];if(isset($data['fileExtension'])){$extension=explode("~",$data['fileExtension']);}

              //homework document uploader
              for ($i=0;$i<=5;$i++){
                  if(isset($data['fileList'.$i.''])){
                   $file=$data['fileList'.$i.''];
                   //if file extension available
                   $extension[$i] ? $FileExtension=$extension[$i] : $FileExtension=null;
                   //Store File
                   $fileresult=$this->upload($file,['base64'=>true,'integrate'=>'homework','db_id'=>$homework->id,'extension'=>$FileExtension]);
                   HomeworkAttachmentFile::create(['homework_id' => $homework->id, 'file_name' => $fileresult['file_name'], 'attachment_files' => $fileresult['file_id'],'extension'=> $fileresult['file_extension'], 'user_id' => $data['user_id']]);
                  }
              }
              return response()->json([
                  'result' => 1,
                  'message' => 'record found'
              ], 200);
          }
        }

        return response()->json([
            'result' => 0,
            'message' => 'request failed'
        ], 400);
    }

    public function apihwreport(Request $request)
    {
        /*
         * Merge Search Array
         */
        $search = array();
        $customsearch = array();
        if (isset($request->course_id) && ($request->course_id)) {
            $course = explode("@", $request->course_id);
            $search = array_merge($search, ['course_id' => $course[0], 'section_id' => $course[1]]);
        }
        if (isset($request->subject_id) && ($request->subject_id)) {
            $search = array_merge($search, ['subject_id' => $request->subject_id]);
        }
        if (isset($request->fromdate) && ($request->fromdate) && isset($request->todate) && ($request->todate)) {
            $customsearch = array_merge($customsearch, ['whereBetween' => ['hw_date' => [nowdate($request->fromdate, 'Y-m-d'), nowdate($request->todate, 'Y-m-d')]]]);
        }
        $search=['search'=>$search,'customsearch'=>$customsearch];
        return $this->apigethomeworkrecord($search);
    }

    public function apistudenthwreport($studentid,$hwdate)
    {
        try {
            /*
            * Student Profile Details
            */
            $student = (new StudentRepository())->studentshortlist(['student_id' => $studentid])->first();
        }catch (\Exception $e){}
        if($student){
            /*
             * Homework Search Query Create Custom
             */
            $search=['course_id'=>$student->course_id,'section_id'=>$student->section_id];
            $customsearch=['whereBetween' => ['hw_date' =>[nowdate($hwdate,'Y-m-d'),nowdate($hwdate,'Y-m-d')]]];
            $search=['search'=>$search,'customsearch'=>$customsearch];
            return $this->apigethomeworkrecord($search);
        }
        return response()->json([
            'result' => 0,
            'message' => 'data no found',
            'success' => null
        ], 400);
    }

    /*
     * get homwork data master api
     */
    public function apigethomeworkrecord($search)
    {
     $homeworkdata=[];
     $homework = (new InAppDataRepository())->homeworklist($search);
     if($homework) {
         foreach ($homework as $data) {

             //if homework attachment
             $attachmentfile = [];
             try {
                 foreach ($data->attachment as $data1) {
                     $attachmentfile[] = ['file_name' => $data1->file_name, 'file_path' => FileUrl($data1->attachment_files), 'extension' => $data1->extension];
                 }
             } catch (\Exception $e) {
             }
             $homeworkdata[] = [
                 'id' => $data->id,
                 'course' => $data->CourseSection(),
                 'subject' => $data->SubjectName(),
                 'hw_date' => nowdate($data->hw_date, 'd-M-Y'),
                 'hw_title' => $data->hw_title,
                 'homework' => $data->homework,
                 'with_app' => $data->with_app,
                 'with_text_sms' => $data->with_text_sms,
                 'with_email' => $data->with_email,
                 'with_website' => $data->with_website,
                 'status' => $data->status,
                 'attachments' => $attachmentfile,
                 'submitted_by'=>$data->user ? $data->user->fullName() : "N/A",
                 'submitted_by_profile'=>$data->user ? $data->user->ProfileImage() : null,
             ];
         }
         return response()->json([
             'result' => 1,
             'message' => 'data found',
             'success' => $homeworkdata
         ], 200);

     }else{

         return response()->json([
             'result' => 0,
             'message' => 'data no found',
             'success' => null
         ], 400);
     }

    }

    public function hwremove($userid,Homework $homework)
    {
        $homework->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Homework Remove Successful Complete',
            'success' => null
        ], 200);
    }

}
