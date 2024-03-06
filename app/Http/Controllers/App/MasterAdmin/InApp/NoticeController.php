<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Http\Controllers\Controller;
use App\Helper\FileUpload;
use App\Http\Requests\MasterAdmin\InApp\NoticeRequest;
use App\Models\MasterAdmin\InApp\Notice;
use App\Models\MasterAdmin\InApp\NoticeAttachmentFile;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    use FileUpload;

    public function index(Request $request)
    {
        $notice = (new InAppDataRepository())->noticelist([]);
        return view('app.erpmodule.MasterAdmin.InApp.Notice.define-notice', compact(['notice']));
    }

    public function store(NoticeRequest $request)
    {
        // dd($request->all());
        $validateData = $request->validated();
        $request->merge(['notice_date' => Carbon::createFromDate($request->notice_date)->format('Y-m-d')]);
        $notice = Notice::create($request->all());
        if ($notice) {
            if ($request->hasFile(('file_name'))) {
                $file = $request->file('file_name');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filePath = 'uploads/Notice/' .$fileName;
                $file->move(public_path('uploads/Notice'),$fileName );
                    $data = [
                        'notice_id' => $notice->id,
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'extension' => $extension,
                        'user_id' => $notice->user_id
                    ];
                    NoticeAttachmentFile::create($data);
                }
            return back()->withInput()->with('success', 'Notice Upload Successfully');
        } else {
            return back()->with('danger', 'Sorry, Request failed, please try again');
        }
    }

    public function editview(Notice $notice)
    {
        return view('app.erpmodule.MasterAdmin.InApp.Notice.Edit.edit-notice', compact(['notice']));
    }

    public function modify(Notice $notice, NoticeRequest $request)
    {
        $validateData = $request->validated();
        $request->merge(['notice_date' => Carbon::createFromDate($request->notice_date)->format('Y-m-d')]);
        $notice->update($request->all());
        if($request->hasFile('file_name')){
            foreach ($notice->attachment as $attachment) {
            $oldFilePath = public_path('uploads/Notice/' . $attachment->file_name);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $attachment->delete();
        }

            $file = $request->file('file_name');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = 'uploads/Notice/' .$fileName;
            $file->move(public_path('uploads/Notice'), $fileName);

                $attachmentData = [
                    'notice_id' => $notice->id,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'extension' => $extension,
                    'user_id' => $notice->user_id
                ];
                $notice->attachment()->updateOrCreate([], $attachmentData);
            }
            $notice->update($validateData);
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/App/EditViewNotice/' . $notice->id . '/editview']);
        return back()->with('success', 'Notice Record Update Successfully');
    }


    /*
     * Mobile App APi
     */
    public function apistore(Request $request)
    {
        $data=$request->all();
        /*
         * Generate Course and Section id
         */
        $course_id = null;
        $section_id = null;
        if ($request->course_id) {
            $course = explode("@", $request->course_id);
            $course_id = $course[0];
            $section_id = $course[1];
        }

        $datainsert = [
            'type' => strtolower($request->type),
            'course_id' => $course_id,
            'section_id' => $section_id,
            'student_id' => $request->student_id,
            'notice_date' => $request->notice_date,
            'notice_title' => $request->notice_title,
            'notice' => $request->notice,
            'show_date_time' => $request->show_date_time,
            'end_date_time' => $request->end_date_time,
            'with_app' => $request->with_app,
            'with_text_sms' => $request->with_text_sms,
            'with_email' => $request->with_email,
            'with_website' => $request->with_website
        ];

        try {
            $notice=Notice::create($datainsert);
            if($notice){
                //if file extension available
                $extension=[];if(isset($data['fileExtension'])){$extension=explode("~",$data['fileExtension']);}

                //Notice document uploader
                for ($i=0;$i<=5;$i++){
                    if(isset($data['fileList'.$i.''])){
                        $file=$data['fileList'.$i.''];
                        //if file extension available
                        $extension[$i] ? $FileExtension=$extension[$i] : $FileExtension=null;
                        //Store File
                        $fileresult=$this->upload($file,['base64'=>true,'integrate'=>'document','db_id'=>$notice->id,'extension'=>$FileExtension]);
                        NoticeAttachmentFile::create(['notice_id' => $notice->id, 'file_name' => $fileresult['file_name'], 'file_path' => $fileresult['file_id'],'extension'=> $fileresult['file_extension'], 'user_id' => $data['user_id']]);
                    }
                }
                return response()->json([
                    'result' => 1,
                    'message' => 'Notice Create Successful Complete',
                    'success' => null
                ], 200);
            }
        }catch (\Exception $e){}
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Request failed, Please try again.',
            'success' => null
        ], 400);
    }

    /*
     * Mobile Application Teacher and Master Admin Notice Report
     */
    public function apinoticereport(Request $request)
    {
        $search=array();
        if(isset($request->course_id)&&($request->course_id)){
            $course=explode("@",$request->course_id);
            $course_id=$course[0];
            $section_id=$course[1];
            $search=array_merge($search,['course_id'=>$course_id,'section_id'=>$section_id]);
        }
        $customsearch=array();
        if(isset($request->notice_date_from)&&($request->notice_date_from) && isset($request->notice_date_to)&&($request->notice_date_to)){
            $customsearch=array_merge($customsearch,['whereBetween'=>['notice_date'=>[nowdate($request->notice_date_from,'Y-m-d'),nowdate($request->notice_date_to,'Y-m-d')]]]);
        }
        $search=['search'=>$search,'customsearch'=>$customsearch];
        return $this->apinoticerecord($search);
    }

    /*
     * Mobile Application Student Notice Report
     */
    public function apistudentnoticereport($studentid)
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
            $search=['search'=>$search,'colsearch'=>['orWhereNull'=>'course_id','operator'=>'orWhere']];
            return $this->apinoticerecord($search);
        }
        return response()->json([
            'result' => 0,
            'message' => 'data no found',
            'success' => null
        ], 400);
    }

    /*
     * get Mobile Api Notice Master Data
     */
    public function apinoticerecord($search=null)
    {
        $noticedata = [];
        $notice = (new InAppDataRepository())->noticelist($search)->sortByDesc('notice_date');
        if ($notice) {

            foreach ($notice as $data) {

                //dd($data);
                //if notice attachment
                $attachmentfile = [];
                try {
                    foreach ($data->attachment as $data1) {
                        $attachmentfile[] = ['file_name' => $data1->file_name, 'file_path' => FileUrl($data1->file_path), 'extension' => $data1->extension];
                    }
                } catch (\Exception $e) {
                }

                $noticedata[] = [
                    'notice_id' => $data->id,
                    'type' => $data->type,
                    'course' => $data->CourseSection(),
                    'student' => $data->StudentName(),
                    'staff' => $data->TeacherName(),
                    'notice_date' => nowdate($data->notice_date, 'd-M-Y'),
                    'notice_title' => $data->notice_title,
                    'notice' => $data->notice,
                    'show_date_time' => $data->show_date_time,
                    'end_date_time' => $data->end_date_time,
                    'with_app' => $data->with_app,
                    'with_text_sms' => $data->with_text_sms,
                    'with_email' => $data->with_email,
                    'with_website' => $data->with_website,
                    'status' => $data->status,
                    'submitted_by' => $data->user ? $data->user->fullName() : "N/A",
                    'submitted_by_profile' => $data->user ? $data->user->ProfileImage() : null,
                    'attachments' => $attachmentfile
                ];
            }

            return response()->json([
                'result' => 1,
                'message' => 'record found',
                'success' => $noticedata
            ],200);

        }
        return response()->json([
            'result' => 0,
            'message' => 'record no found',
            'success' => null
        ],200);
    }

    /*
     * Api Remove Notice
     */
    public function removenotice($userid,Notice $notice)
    {
        $notice->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Notice Remove Successful Complete',
            'success' => null
        ]);
    }

}
